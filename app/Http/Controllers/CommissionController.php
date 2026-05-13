<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\View\View;

class CommissionController extends Controller
{
    public function index(): View
    {
        $commissions = Commission::withCount(['users', 'activities'])->get();

        return view('commissions.index', compact('commissions'));
    }
}
