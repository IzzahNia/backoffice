<?php

namespace App\Livewire\Applications;

use App\Models\Application;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $filterInput = [
        'search' => '',
        'status' => '',
        'type' => '',
        'perPage' => 10,
    ];

    public $appliedFilters = [
        'search' => '',
        'status' => '',
        'type' => '',
        'perPage' => 10,
    ];

    protected $listeners = ['applicationSaved' => '$refresh'];

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
        $query = Application::query();

        if ($this->appliedFilters['search']) {
            $query->where(function($q) {
                $q->where('title', 'like', '%'.$this->appliedFilters['search'].'%')
                  ->orWhere('description', 'like', '%'.$this->appliedFilters['search'].'%');
            });
        }

        if ($this->appliedFilters['status']) {
            $query->where('status', $this->appliedFilters['status']);
        }

        if ($this->appliedFilters['type']) {
            $query->where('type', $this->appliedFilters['type']);
        }

        $applications = $query->latest()->paginate($this->appliedFilters['perPage']);

        return view('livewire.applications.table', compact('applications'));
    }
}
