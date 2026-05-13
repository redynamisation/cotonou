<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Finance;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class DashboardStats extends Component
{
    public int $totalMembers = 0;
    public int $activeActivities = 0;
    public int $completedTasks = 0;
    public float $fundsRaised = 0;
    public array $topMembers = [];
    public array $recentEvents = [];
    public array $impactStats = [];

    public function mount(): void
    {
        $this->totalMembers = User::count();
        $this->activeActivities = Activity::whereIn('status', ['planned', 'active'])->count();
        $this->completedTasks = Task::where('is_completed', true)->count();
        $this->fundsRaised = Finance::whereIn('type_flux', ['cotisation', 'sponsoring', 'vente', 'revenu'])->sum('amount');
        $this->topMembers = User::orderByDesc('points_motivation')->limit(5)->get()->toArray();
        $this->recentEvents = Activity::orderByDesc('scheduled_at')->limit(3)->get()->toArray();
        $this->impactStats = [
            'Mosquées nettoyées' => Activity::where('impact_metric', 'like', '%mosquée%')->count(),
            'Orphelinats soutenus' => Activity::where('impact_metric', 'like', '%orphelinat%')->count(),
            'Ateliers lancés' => Activity::where('impact_metric', 'like', '%atelier%')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
