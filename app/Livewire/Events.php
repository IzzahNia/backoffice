<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Events extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();

            if (Event::paginate(10)->isEmpty()) {
                $this->resetPage();
            }
            session()->flash('message', 'Event deleted successfully.');
        } else {
            session()->flash('error', 'Event not found.');
        }
    }

    public $name;
    public $description;
    public $start_time;
    public $end_time;
    public $location;
    public $is_verified = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'location' => 'required|string|max:255',
        'is_verified' => 'boolean',
    ];

    public function create()
    {
        $this->validate();

        if ($this->getErrorBag()->isNotEmpty()) {
            return;
        }

        Event::create([
            'name' => $this->name,
            'description' => $this->description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'location' => $this->location,
            'is_verified' => $this->is_verified,
            'user_id' => Auth::id(), // Automatically assign the authenticated user's ID
        ]);

        $this->reset(['name', 'description', 'start_time', 'end_time', 'location', 'is_verified']);
        session()->flash('message', 'Event created successfully!');
    }

    public function render()
    {
        $events = Event::latest()->paginate(10);

        return view('livewire.events', compact('events'));
    }
}
