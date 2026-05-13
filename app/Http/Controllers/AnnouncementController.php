<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Commission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::with('commission')->latest('published_at')->get();

        return view('announcements.index', compact('announcements'));
    }

    public function adminIndex(): View
    {
        $this->authorizeManager();

        $announcements = Announcement::with('commission')->latest('published_at')->get();
        $commissions = Commission::orderBy('name')->get();

        return view('admin.announcements', compact('announcements', 'commissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeManager();

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'string'],
            'type' => ['required', 'in:annonce,communique'],
            'commission_id' => ['nullable', 'exists:commissions,id'],
        ]);

        Announcement::create(array_merge($validated, ['commission_id' => $validated['commission_id'] ?: null, 'published_at' => now()]));

        return back()->with('status', 'Annonce ajoutée avec succès.');
    }

    protected function authorizeManager(): void
    {
        if (! auth()->user()?->isAdmin() && ! auth()->user()?->isCommissionLead()) {
            abort(403);
        }
    }
}
