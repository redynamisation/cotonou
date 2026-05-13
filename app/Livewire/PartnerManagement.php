<?php

namespace App\Livewire;

use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;

class PartnerManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $name = '';
    public $description = '';
    public $website = '';
    public $logo_url = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'website' => 'nullable|url|max:255',
        'logo_url' => 'nullable|url|max:255',
    ];

    public function render()
    {
        $query = Partner::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
        }

        $partners = $query->latest()->paginate(10);

        return view('livewire.partner-management', compact('partners'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $partner = Partner::findOrFail($id);
        $this->editingId = $id;
        $this->name = $partner->name;
        $this->description = $partner->description;
        $this->website = $partner->website;
        $this->logo_url = $partner->logo_url;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->formMode === 'create') {
            Partner::create([
                'name' => $this->name,
                'description' => $this->description,
                'website' => $this->website,
                'logo_url' => $this->logo_url,
            ]);
            session()->flash('success', 'Partenaire créé avec succès');
        } else {
            $partner = Partner::findOrFail($this->editingId);
            $partner->update([
                'name' => $this->name,
                'description' => $this->description,
                'website' => $this->website,
                'logo_url' => $this->logo_url,
            ]);
            session()->flash('success', 'Partenaire mis à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        Partner::findOrFail($id)->delete();
        session()->flash('success', 'Partenaire supprimé avec succès');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->website = '';
        $this->logo_url = '';
        $this->showForm = false;
        $this->editingId = null;
    }
}
