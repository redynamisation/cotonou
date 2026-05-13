<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinanceController extends Controller
{
    public function index(Request $request): View
    {
        $eventId = $request->query('event_id');
        $events = Event::orderBy('title')->get();

        $query = Finance::with(['commission', 'event'])->orderByDesc('recorded_at');

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        $finances = $query->get();

        $totals = [
            'recettes' => $finances->whereIn('type_flux', ['cotisation', 'sponsoring', 'vente', 'revenu'])->sum('amount'),
            'depenses' => $finances->where('type_flux', 'dépense')->sum('amount'),
        ];
        $totals['net'] = $totals['recettes'] - $totals['depenses'];

        $eventTotals = $finances->groupBy(fn ($finance) => $finance->event?->title ?? 'Général')
            ->map(function ($group) {
                return [
                    'recettes' => $group->whereIn('type_flux', ['cotisation', 'sponsoring', 'vente', 'revenu'])->sum('amount'),
                    'depenses' => $group->where('type_flux', 'dépense')->sum('amount'),
                    'net' => $group->whereIn('type_flux', ['cotisation', 'sponsoring', 'vente', 'revenu'])->sum('amount') - $group->where('type_flux', 'dépense')->sum('amount'),
                ];
            });

        return view('finances.index', compact('finances', 'totals', 'events', 'eventTotals', 'eventId'));
    }
}
