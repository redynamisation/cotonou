<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Commission;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'desc';
    
    public $showForm = false;
    public $formMode = 'create';
    public $editingId = null;

    public $name = '';
    public $email = '';
    public $password = '';
    public $role = 'member';
    public $commission_id = '';
    public $school = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'role' => 'required|in:admin,lead_sociale,lead_communication,member',
        'commission_id' => 'nullable|exists:commissions,id',
        'school' => 'nullable|string|max:255',
    ];

    public function render()
    {
        $query = User::query();
        
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
        }
        
        $users = $query->orderBy($this->sortBy, $this->sortDir)
                       ->paginate(10);

        $commissions = Commission::all();

        return view('livewire.user-management', compact('users', 'commissions'));
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->formMode = 'create';
        $this->showForm = true;
    }

    public function openEdit($id)
    {
        $user = User::findOrFail($id);
        $this->editingId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->commission_id = $user->commission_id;
        $this->school = $user->school;
        $this->formMode = 'edit';
        $this->showForm = true;
    }

    public function save()
    {
        if ($this->formMode === 'create') {
            $this->validate();
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role' => $this->role,
                'commission_id' => $this->commission_id ?: null,
                'school' => $this->school,
            ]);
            session()->flash('success', 'Utilisateur créé avec succès');
        } else {
            $this->validate([
                'name' => 'required|string|max:255',
                'role' => 'required|in:admin,lead_sociale,lead_communication,member',
                'commission_id' => 'nullable|exists:commissions,id',
                'school' => 'nullable|string|max:255',
            ]);
            $user = User::findOrFail($this->editingId);
            $user->update([
                'name' => $this->name,
                'role' => $this->role,
                'commission_id' => $this->commission_id ?: null,
                'school' => $this->school,
            ]);
            session()->flash('success', 'Utilisateur mis à jour avec succès');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'Utilisateur supprimé avec succès');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'member';
        $this->commission_id = '';
        $this->school = '';
        $this->showForm = false;
        $this->editingId = null;
    }

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDir = 'asc';
        }
    }
}
