<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;
    protected $listeners = ['userCreated' => 'render'];

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            if (User::paginate(10)->isEmpty()) {
                $this->resetPage();
            }
            session()->flash('message', 'User deleted successfully.');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function create() {
        $this->validate();

        if ($this->getErrorBag()->isNotEmpty()) {
            return;
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->reset(['name', 'email', 'password']);
        session()->flash('message', 'User created successfully!');

        // $this->emit('userCreated');
    }

    public function render()
    {
        $users = User::latest()->paginate(10);

        return view('livewire.users', compact('users'));
    }
}
