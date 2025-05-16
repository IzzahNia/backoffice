<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\WithPagination;
use Livewire\Component;

class Table extends Component
{
    use WithPagination;

    protected $listeners = ['eventSaved' => '$refresh'];

    public $filterInput = [
        'search' => '',
        'perPage' => 5,
    ];

    public $appliedFilters = [
        'search' => '',
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
        $query = Event::query();

        if ($this->appliedFilters['search']) {
            $query->where(function($q) {
                $q->where('name', 'like', '%'.$this->appliedFilters['search'].'%')
                  ->orWhere('location', 'like', '%'.$this->appliedFilters['search'].'%');
            });
        }

        $events = $query->latest()->paginate($this->appliedFilters['perPage']);

        return view('livewire.events.table', compact('events'));
    }
}
