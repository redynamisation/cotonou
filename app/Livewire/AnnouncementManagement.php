<?php

namespace App\Livewire;

use App\Models\Announcement;
use App\Models\Commission;
use Livewire\Component;
use Livewire\WithPagination;

class AnnouncementManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $title = '';
    public $content = '';
    public $type = 'annonce';
    public $commission_id = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'type' => 'required|in:annonce,communique',
        'commission_id' => 'nullable|exists:commissions,id',
    ];

    public function render()
    {
        $query = Announcement::with('commission')->latest('published_at');

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%");
        }

        $announcements = $query->paginate(10);
        $commissions = Commission::orderBy('name')->get();

        return view('livewire.announcement-management', compact('announcements', 'commissions'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $this->editingId = $id;
        $this->title = $announcement->title;
        $this->content = $announcement->content;
        $this->type = $announcement->type;
        $this->commission_id = $announcement->commission_id;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->formMode === 'create') {
            Announcement::create([
                'title' => $this->title,
                'content' => $this->content,
                'type' => $this->type,
                'commission_id' => $this->commission_id ?: null,
                'published_at' => now(),
            ]);
            session()->flash('success', 'Annonce créée avec succès');
        } else {
            $announcement = Announcement::findOrFail($this->editingId);
            $announcement->update([
                'title' => $this->title,
                'content' => $this->content,
                'type' => $this->type,
                'commission_id' => $this->commission_id ?: null,
            ]);
            session()->flash('success', 'Annonce mise à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        Announcement::findOrFail($id)->delete();
        session()->flash('success', 'Annonce supprimée avec succès');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->content = '';
        $this->type = 'annonce';
        $this->commission_id = '';
        $this->showForm = false;
        $this->editingId = null;
    }
}
