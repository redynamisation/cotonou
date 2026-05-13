<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Finance;
use App\Models\LibraryDocument;
use App\Models\Partner;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::with('commission')->latest('published_at')->take(3)->get();
        $events = Event::with('commission')->upcoming()->take(4)->get();
        $documents = LibraryDocument::latest('created_at')->take(4)->get();
        $partners = Partner::latest('created_at')->take(6)->get();

        $recettes = Finance::whereIn('type_flux', ['cotisation', 'sponsoring', 'vente', 'revenu'])->sum('amount');
        $depenses = Finance::where('type_flux', 'dépense')->sum('amount');
        $solde = $recettes - $depenses;

        return view('home', compact('announcements', 'events', 'documents', 'partners', 'recettes', 'depenses', 'solde'));
    }
}
