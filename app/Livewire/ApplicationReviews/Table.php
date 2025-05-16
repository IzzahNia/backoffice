<?php

namespace App\Livewire\ApplicationReviews;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ApplicationReview;
use App\Models\Application;
use App\Models\User;

class Table extends Component
{
    use WithPagination;

    public $filterInput = [
        'search' => '',
        'admin_id' => '',
        'perPage' => 10,
    ];

    public $appliedFilters = [
        'search' => '',
        'admin_id' => '',
        'perPage' => 10,
    ];

    protected $listeners = ['reviewSaved' => '$refresh'];

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
        $query = ApplicationReview::query()->with(['application', 'admin']);

        if ($this->appliedFilters['search']) {
            $query->where('comment', 'like', '%'.$this->appliedFilters['search'].'%');
        }

        if ($this->appliedFilters['admin_id']) {
            $query->where('admin_id', $this->appliedFilters['admin_id']);
        }

        $reviews = $query->latest()->paginate($this->appliedFilters['perPage']);
        $admins = User::where('role', 'admin')->pluck('name', 'id');

        return view('livewire.applicationReviews.table', compact('reviews', 'admins'));
    }
}
