<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Component;
use App\Models\User;

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
    public $userRoleCounts = [];

    public function mount()
    {
        // Get count of users by role
        $this->userRoleCounts = User::select('role')
            ->selectRaw('count(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role')
            ->toArray();

        // Fetch pending applications sorted by the oldest first
        $this->pendingReviews = Application::where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->with(['user', 'event'])
            ->get();

        // Get count of applications by status
        $this->applicationStatusCounts = Application::select('status')
            ->selectRaw('count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Get total applications by month for the current year
        $this->applicationsByMonth = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Get count of applications by type
        $this->applicationTypeCounts = Application::select('type')
            ->selectRaw('count(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

    }

    public function render()
    {
        return view('livewire.dashboard-admin', [
            'pendingReviews' => $this->pendingReviews,
            'userRoleCounts' => $this->userRoleCounts,
            'applicationStatusCounts' => $this->applicationStatusCounts,
            'applicationsByMonth' => $this->applicationsByMonth,
            'applicationTypeCounts' => $this->applicationTypeCounts,
        ]);
    }
}
