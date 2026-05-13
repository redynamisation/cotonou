<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Commission;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ActivityManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCommission = '';
    public $filterStatus = '';
    
    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $commission_id = '';
    public $title = '';
    public $scheduled_at = '';
    public $status = 'planned';
    public $budget = '';
    public $impact_metric = '';
    public $notes = '';

    protected $rules = [
        'commission_id' => 'required|exists:commissions,id',
        'title' => 'required|string|max:255',
        'scheduled_at' => 'required|date',
        'status' => 'required|in:planned,active,completed,cancelled',
        'budget' => 'nullable|numeric|min:0',
        'impact_metric' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ];

    public function render()
    {
        $query = Activity::query();

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        if ($this->filterCommission) {
            $query->where('commission_id', $this->filterCommission);
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $activities = $query->orderByDesc('scheduled_at')->paginate(10);
        $commissions = Commission::all();
        $statuses = ['planned', 'active', 'completed', 'cancelled'];

        return view('livewire.activity-management', compact('activities', 'commissions', 'statuses'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $activity = Activity::findOrFail($id);
        $this->editingId = $id;
        $this->commission_id = $activity->commission_id;
        $this->title = $activity->title;
        $this->scheduled_at = $activity->scheduled_at->format('Y-m-d\TH:i');
        $this->status = $activity->status;
        $this->budget = $activity->budget;
        $this->impact_metric = $activity->impact_metric;
        $this->notes = $activity->notes;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->formMode === 'create') {
            Activity::create([
                'commission_id' => $this->commission_id,
                'title' => $this->title,
                'scheduled_at' => $this->scheduled_at,
                'status' => $this->status,
                'budget' => $this->budget ?: 0,
                'impact_metric' => $this->impact_metric,
                'notes' => $this->notes,
            ]);
            session()->flash('success', 'Activité créée avec succès');
        } else {
            $activity = Activity::findOrFail($this->editingId);
            $activity->update([
                'commission_id' => $this->commission_id,
                'title' => $this->title,
                'scheduled_at' => $this->scheduled_at,
                'status' => $this->status,
                'budget' => $this->budget ?: 0,
                'impact_metric' => $this->impact_metric,
                'notes' => $this->notes,
            ]);
            session()->flash('success', 'Activité mise à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        Activity::findOrFail($id)->delete();
        session()->flash('success', 'Activité supprimée avec succès');
    }

    public function resetForm()
    {
        $this->commission_id = '';
        $this->title = '';
        $this->scheduled_at = '';
        $this->status = 'planned';
        $this->budget = '';
        $this->impact_metric = '';
        $this->notes = '';
        $this->showForm = false;
        $this->editingId = null;
    }
}
