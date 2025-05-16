<?php

namespace App\Livewire\Users;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Component;

class Table extends Component
{
    use WithPagination;

    protected $listeners = ['userSaved' => '$refresh'];

    public $filterInput = [
        'search' => '',
        'role' => '',
        'perPage' => 5,
    ];

    public $appliedFilters = [
        'search' => '',
        'role' => '',
        'perPage' => 5,
    ];

    public function mount()
    {
        $this->filterInput = $this->appliedFilters;
    }

    public function applyFilters()
    {
        $this->appliedFilters = $this->filterInput;
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        if ($this->appliedFilters['search']) {
            $query->where(function($q) {
                $q->where('name', 'like', '%'.$this->appliedFilters['search'].'%')
                  ->orWhere('email', 'like', '%'.$this->appliedFilters['search'].'%');
            });
        }

        if ($this->appliedFilters['role']) {
            $query->where('role', $this->appliedFilters['role']);
        }

        $users = $query->latest()->paginate($this->appliedFilters['perPage']);

        return view('livewire.users.table', compact('users'));
    }
}
