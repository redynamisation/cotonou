<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $partners = Partner::orderByDesc('created_at')->get();

        return view('partners.index', compact('partners'));
    }

    public function adminIndex(): View
    {
        $this->authorizeManager();

        $partners = Partner::orderByDesc('created_at')->get();

        return view('admin.partners', compact('partners'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeManager();

        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'website' => ['nullable', 'url'],
            'logo_url' => ['nullable', 'url'],
        ]);

        Partner::create($validated);

        return back()->with('status', 'Partenaire ajouté avec succès.');
    }

    protected function authorizeManager(): void
    {
        if (! auth()->user()?->isAdmin() && ! auth()->user()?->isCommissionLead()) {
            abort(403);
        }
    }
}
