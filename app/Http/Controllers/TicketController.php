<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(): View
    {
        $tickets = Ticket::orderByDesc('sold_at')->get();

        $summary = [
            'sold' => $tickets->count(),
            'revenue' => $tickets->sum('price'),
        ];

        return view('events.index', compact('tickets', 'summary'));
    }
}
