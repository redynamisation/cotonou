<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function adminIndex(): View
    {
        $this->authorizeManager();

        $events = Event::with('commission')->orderByDesc('start_at')->get();
        $commissions = Commission::orderBy('name')->get();

        return view('admin.events', compact('events', 'commissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeManager();

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['required', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:planned,open,termine'],
            'poster_url' => ['nullable', 'url'],
            'commission_id' => ['nullable', 'exists:commissions,id'],
        ]);

        Event::create(array_merge($validated, ['commission_id' => $validated['commission_id'] ?: null]));

        return back()->with('status', 'Événement créé avec succès.');
    }

    protected function authorizeManager(): void
    {
        if (! auth()->user()?->isAdmin() && ! auth()->user()?->isCommissionLead()) {
            abort(403);
        }
    }
}
