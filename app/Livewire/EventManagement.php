<?php

namespace App\Livewire;

use App\Models\Commission;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCommission = '';
    public $filterStatus = '';

    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $title = '';
    public $description = '';
    public $location = '';
    public $start_at = '';
    public $end_at = '';
    public $price = '';
    public $status = 'planned';
    public $poster_url = '';
    public $commission_id = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'location' => 'required|string|max:255',
        'start_at' => 'required|date',
        'end_at' => 'nullable|date|after_or_equal:start_at',
        'price' => 'nullable|numeric|min:0',
        'status' => 'required|in:planned,open,termine',
        'poster_url' => 'nullable|url|max:255',
        'commission_id' => 'nullable|exists:commissions,id',
    ];

    public function render()
    {
        $query = Event::with('commission');

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('location', 'like', "%{$this->search}%");
        }

        if ($this->filterCommission) {
            $query->where('commission_id', $this->filterCommission);
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $events = $query->latest('start_at')->paginate(10);
        $commissions = Commission::orderBy('name')->get();

        return view('livewire.event-management', compact('events', 'commissions'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $event = Event::findOrFail($id);
        $this->editingId = $id;
        $this->title = $event->title;
        $this->description = $event->description;
        $this->location = $event->location;
        $this->start_at = $event->start_at?->format('Y-m-d\TH:i');
        $this->end_at = $event->end_at?->format('Y-m-d\TH:i');
        $this->price = $event->price;
        $this->status = $event->status;
        $this->poster_url = $event->poster_url;
        $this->commission_id = $event->commission_id;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at ?: null,
            'price' => $this->price ?: 0,
            'status' => $this->status,
            'poster_url' => $this->poster_url,
            'commission_id' => $this->commission_id ?: null,
        ];

        if ($this->formMode === 'create') {
            Event::create($data);
            session()->flash('success', 'Événement créé avec succès');
        } else {
            $event = Event::findOrFail($this->editingId);
            $event->update($data);
            session()->flash('success', 'Événement mis à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        Event::findOrFail($id)->delete();
        session()->flash('success', 'Événement supprimé avec succès');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->location = '';
        $this->start_at = '';
        $this->end_at = '';
        $this->price = '';
        $this->status = 'planned';
        $this->poster_url = '';
        $this->commission_id = '';
        $this->showForm = false;
        $this->editingId = null;
    }
}
