<?php

namespace App\Livewire\Users;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Validation\Rules\Enum;

use Livewire\Component;

class Form extends Component
{
    public $userId;
    public $name = '';
    public $email = '';
    public $role = '';
    public $password = '';
    public $showModal = false;
    public $mode = 'create'; // or 'edit'

    protected $listeners = ['showUserForm' => 'show', 'hideUserForm' => 'hide'];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => ['required', new Enum(UserRole::class)],
        ];

        // Password required on create, optional on edit
        if ($this->mode === 'create') {
            $rules['password'] = 'required|string|min:6';
        } else {
            $rules['password'] = 'nullable|string|min:6';
        }

        return $rules;
    }

    public function show($userId = null)
    {
        if ($userId) {
            $user = User::findOrFail($userId);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->password = '';
            $this->mode = 'edit';
        } else {
            $this->reset(['userId', 'name', 'email', 'role', 'password']);
            $this->mode = 'create';
        }
        $this->showModal = true;
    }

    public function hide()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();

        if ($this->mode === 'edit') {
            $user = User::findOrFail($this->userId);
            $updateData = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ];
            if ($this->password) {
                $updateData['password'] = bcrypt($this->password);
            }
            $user->update($updateData);
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => bcrypt($this->password),
            ]);
        }

        $this->dispatch('userSaved');
        $this->hide();
    }

    public function render()
    {
        return view('livewire.users.form', [
        'roles' => UserRole::cases(),
    ]);
    }
}
