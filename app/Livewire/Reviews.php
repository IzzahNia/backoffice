<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ApplicationReview;
use App\Models\Application;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Reviews extends Component
{
    use WithPagination;

    public $showModal = false;
    public $selectedApplication;
    public string $comment = '';

    public function openModal($applicationId)
    {
        $this->selectedApplication = Application::findOrFail($applicationId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedApplication = null;
    }

    public function approveApplication()
    {
        if ($this->selectedApplication) {
            // Create a new review
            ApplicationReview::create([
                'application_id' => $this->selectedApplication->id,
                'admin_id' => Auth::id(),
                'comment' => $this->comment ?? 'Application approved.',
            ]);

            // Update the application's status
            $this->selectedApplication->update(['status' => 'approved']);

            // Close the modal and refresh the list
            $this->closeModal();
            session()->flash('message', 'Application approved successfully!');
            return redirect()->route('review');
        }
    }

    public function rejectApplication()
    {
        if ($this->selectedApplication) {
            // Create a new review
            ApplicationReview::create([
                'application_id' => $this->selectedApplication->id,
                'admin_id' => Auth::id(),
                'comment' => $this->comment ??'Application rejected.',
            ]);

            // Update the application's status
            $this->selectedApplication->update(['status' => 'rejected']);

            // Close the modal and refresh the list
            $this->closeModal();
            session()->flash('message', 'Application rejected successfully!');
            return redirect()->route('review');
        }
    }

    public function render()
    {
        // Fetch all applications with a 'pending' status
        $pendingApplications = Application::where('status', 'pending')->latest()->paginate(10);

        // Fetch all applications that are approved or rejected, with their reviews
        $reviewedApplications = Application::whereIn('status', ['approved', 'rejected'])
        ->with('review') // Include the review relationship
        ->latest()
        ->paginate(10);

        return view('livewire.reviews', compact('pendingApplications', 'reviewedApplications'));
    }
}
