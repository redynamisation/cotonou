<?php

namespace App\Http\Controllers;

use App\Models\LibraryDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function index(): View
    {
        $documents = LibraryDocument::orderByDesc('created_at')->get();

        return view('library.index', compact('documents'));
    }

    public function adminIndex(): View
    {
        $this->authorizeManager();

        $documents = LibraryDocument::orderByDesc('created_at')->get();

        return view('admin.library', compact('documents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeManager();

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'max:100'],
            'url' => ['required', 'url'],
        ]);

        LibraryDocument::create($validated);

        return back()->with('status', 'Ressource ajoutée à la bibliothèque.');
    }

    protected function authorizeManager(): void
    {
        if (! auth()->user()?->isAdmin() && ! auth()->user()?->isCommissionLead()) {
            abort(403);
        }
    }
}
