<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardVendor extends Component
{
    /**
     * TODO: Add properties and methods as needed for the dashboard functionality.
     * For example, you might want to add properties for user statistics,
     * -applications status overview (accepted, pending, rejected)
     * - recent activity
     * - upcoming events
     */

    public function render()
    {
        return view('livewire.dashboard-vendor');
    }
}
