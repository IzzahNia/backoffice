<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $role;
    public $userId; // For editing
    public $showModal = false; // To control modal visibility
    public $isEditMode = false; // To toggle between create and edit
    public $roles = ['admin', 'user', 'vendor']; // Define roles enum

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->reset(['name', 'email', 'password', 'role', 'userId', 'isEditMode']);

        if ($id) {
            $this->isEditMode = true;
            $user = User::findOrFail($id);

            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'email', 'password', 'role', 'userId', 'isEditMode']);
    }

    public function save()
    {
        // Adjust validation rules dynamically
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($this->isEditMode ? ',' . $this->userId : ''),
            'password' => $this->isEditMode ? 'nullable|min:6' : 'required|min:6',
            'role' => 'required|in:' . implode(',', $this->roles),
        ];

        $this->validate($rules);

        if ($this->isEditMode) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? bcrypt($this->password) : $user->password,
                'role' => $this->role,
            ]);
            session()->flash('message', 'User updated successfully!');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role' => $this->role,
            ]);
            session()->flash('message', 'User created successfully!');
        }
        $this->closeModal();
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function render()
    {
        $users = User::latest()->paginate(10);

        return view('livewire.users', compact('users'));
    }
}
