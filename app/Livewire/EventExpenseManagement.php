<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\EventExpense;
use Livewire\Component;
use Livewire\WithPagination;

class EventExpenseManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterEvent = '';

    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $event_id = '';
    public $description = '';
    public $amount = '';
    public $occurred_at = '';
    public $notes = '';

    protected $rules = [
        'event_id' => 'required|exists:events,id',
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'occurred_at' => 'required|date',
        'notes' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $query = EventExpense::with('event')->latest('occurred_at');

        if ($this->search) {
            $query->where('description', 'like', "%{$this->search}%")
                  ->orWhere('notes', 'like', "%{$this->search}%");
        }

        if ($this->filterEvent) {
            $query->where('event_id', $this->filterEvent);
        }

        $expenses = $query->paginate(10);
        $events = Event::orderBy('title')->get();

        return view('livewire.event-expense-management', compact('expenses', 'events'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $expense = EventExpense::findOrFail($id);
        $this->editingId = $id;
        $this->event_id = $expense->event_id;
        $this->description = $expense->description;
        $this->amount = $expense->amount;
        $this->occurred_at = $expense->occurred_at?->format('Y-m-d');
        $this->notes = $expense->notes;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'event_id' => $this->event_id,
            'description' => $this->description,
            'amount' => $this->amount,
            'occurred_at' => $this->occurred_at,
            'notes' => $this->notes,
        ];

        if ($this->formMode === 'create') {
            EventExpense::create($data);
            session()->flash('success', 'Dépense enregistrée avec succès');
        } else {
            $expense = EventExpense::findOrFail($this->editingId);
            $expense->update($data);
            session()->flash('success', 'Dépense mise à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        EventExpense::findOrFail($id)->delete();
        session()->flash('success', 'Dépense supprimée avec succès');
    }

    public function resetForm()
    {
        $this->event_id = '';
        $this->description = '';
        $this->amount = '';
        $this->occurred_at = '';
        $this->notes = '';
        $this->showForm = false;
        $this->editingId = null;
    }
}
