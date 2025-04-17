<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Application;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class Applications extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $application = Application::find($id);
        if ($application) {
            $application->delete();

            if (Application::paginate(10)->isEmpty()) {
                $this->resetPage();
            }
            session()->flash('message', 'Event deleted successfully.');
        } else {
            session()->flash('error', 'Event not found.');
        }
    }

    public $title;
    public $description;
    public $event_id;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'event_id' => 'nullable|exists:events,id', // event_id is now nullable
    ];

    public function create()
    {
        $this->validate();

        if ($this->getErrorBag()->isNotEmpty()) {
            return;
        }

        Application::create([
            'title' => $this->title,
            'description' => $this->description,
            'event_id' => $this->event_id, // Can be null
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        $this->reset(['title', 'description', 'event_id']);
        session()->flash('message', 'Event created successfully!');
    }

    public function approve($id)
    {
        $application = Application::find($id);
        if ($application) {
            $application->update(['status' => 'approved']);
            session()->flash('message', 'Application approved successfully.');
        } else {
            session()->flash('error', 'Application not found.');
        }
    }

    public function reject($id)
    {
        $application = Application::find($id);
        if ($application) {
            $application->update(['status' => 'rejected']);
            session()->flash('message', 'Application rejected successfully.');
        } else {
            session()->flash('error', 'Application not found.');
        }
    }

    public function render()
    {
        $applications = Application::latest()->paginate(10);
        $events = Event::where('user_id', Auth::id())
                   ->where('is_verified', 0) // Assuming 0 means "pending"
                   ->get();



        return view('livewire.applications', compact('applications', 'events'));
    }
}
