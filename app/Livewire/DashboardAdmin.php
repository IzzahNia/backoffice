<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Component;

class DashboardAdmin extends Component
{
    /**
     * TODO: Add properties and methods as needed for the dashboard functionality.
     * For example, you might want to add properties for user statistics,
     * - pending applications review
     * - vendor category distribution
     * - weekly attendance
     * - revenue trend
     * - total revenue
     * - total number of vendors
     * - total number of users
     * - total events
     * - average rating
     * - total crews
     */

    public $pendingReviews;

    public function mount()
    {
        // Fetch pending applications sorted by the oldest first
        $this->pendingReviews = Application::where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->with(['user', 'event'])
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard-admin', [
            'pendingReviews' => $this->pendingReviews,
        ]);
    }
}
