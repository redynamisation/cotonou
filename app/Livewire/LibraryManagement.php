<?php

namespace App\Livewire;

use App\Models\LibraryDocument;
use Livewire\Component;
use Livewire\WithPagination;

class LibraryManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $title = '';
    public $description = '';
    public $category = '';
    public $url = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category' => 'required|string|max:100',
        'url' => 'required|url|max:255',
    ];

    public function render()
    {
        $query = LibraryDocument::query();

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('category', 'like', "%{$this->search}%");
        }

        $documents = $query->latest()->paginate(10);

        return view('livewire.library-management', compact('documents'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $document = LibraryDocument::findOrFail($id);
        $this->editingId = $id;
        $this->title = $document->title;
        $this->description = $document->description;
        $this->category = $document->category;
        $this->url = $document->url;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->formMode === 'create') {
            LibraryDocument::create([
                'title' => $this->title,
                'description' => $this->description,
                'category' => $this->category,
                'url' => $this->url,
            ]);
            session()->flash('success', 'Ressource créée avec succès');
        } else {
            $document = LibraryDocument::findOrFail($this->editingId);
            $document->update([
                'title' => $this->title,
                'description' => $this->description,
                'category' => $this->category,
                'url' => $this->url,
            ]);
            session()->flash('success', 'Ressource mise à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        LibraryDocument::findOrFail($id)->delete();
        session()->flash('success', 'Ressource supprimée avec succès');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category = '';
        $this->url = '';
        $this->showForm = false;
        $this->editingId = null;
    }
}
