<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Activity;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TaskManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterActivity = '';
    public $filterCompleted = '';
    
    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $activity_id = '';
    public $responsible_id = '';
    public $title = '';
    public $points_allocated = '';
    public $is_completed = false;
    public $due_date = '';
    public $notes = '';

    protected $rules = [
        'activity_id' => 'required|exists:activities,id',
        'responsible_id' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'points_allocated' => 'required|numeric|min:0',
        'due_date' => 'nullable|date',
        'notes' => 'nullable|string',
    ];

    public function render()
    {
        $query = Task::query();

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        if ($this->filterActivity) {
            $query->where('activity_id', $this->filterActivity);
        }

        if ($this->filterCompleted !== '') {
            $query->where('is_completed', (bool) $this->filterCompleted);
        }

        $tasks = $query->with(['activity', 'responsible'])->orderByDesc('due_date')->paginate(10);
        $activities = Activity::all();
        $users = User::all();

        return view('livewire.task-management', compact('tasks', 'activities', 'users'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $task = Task::findOrFail($id);
        $this->editingId = $id;
        $this->activity_id = $task->activity_id;
        $this->responsible_id = $task->responsible_id;
        $this->title = $task->title;
        $this->points_allocated = $task->points_allocated;
        $this->is_completed = $task->is_completed;
        $this->due_date = $task->due_date?->format('Y-m-d');
        $this->notes = $task->notes;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->formMode === 'create') {
            Task::create([
                'activity_id' => $this->activity_id,
                'responsible_id' => $this->responsible_id,
                'title' => $this->title,
                'points_allocated' => $this->points_allocated,
                'is_completed' => $this->is_completed,
                'due_date' => $this->due_date,
                'notes' => $this->notes,
            ]);
            session()->flash('success', 'Tâche créée avec succès');
        } else {
            $task = Task::findOrFail($this->editingId);
            $task->update([
                'activity_id' => $this->activity_id,
                'responsible_id' => $this->responsible_id,
                'title' => $this->title,
                'points_allocated' => $this->points_allocated,
                'is_completed' => $this->is_completed,
                'due_date' => $this->due_date,
                'notes' => $this->notes,
            ]);
            session()->flash('success', 'Tâche mise à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        Task::findOrFail($id)->delete();
        session()->flash('success', 'Tâche supprimée avec succès');
    }

    public function toggleComplete($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['is_completed' => !$task->is_completed]);
        session()->flash('success', 'Statut mis à jour');
    }

    public function resetForm()
    {
        $this->activity_id = '';
        $this->responsible_id = '';
        $this->title = '';
        $this->points_allocated = '';
        $this->is_completed = false;
        $this->due_date = '';
        $this->notes = '';
        $this->showForm = false;
        $this->editingId = null;
    }
}
