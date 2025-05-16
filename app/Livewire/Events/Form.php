<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Enums\EventType;
use Illuminate\Validation\Rules\Enum;

class Form extends Component
{
    public $eventId;
    public $name = '';
    public $description = '';
    public $start_time = '';
    public $end_time = '';
    public $location = '';
    public $type = '';
    public $is_verified = false;
    public $showModal = false;
    public $mode = 'create'; // or 'edit'

    protected $listeners = ['showEventForm' => 'show', 'hideEventForm' => 'hide'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => ['required', new Enum(EventType::class)],
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'location' => 'required|string|max:255',
            'is_verified' => 'boolean',
        ];
    }

    public function show($eventId = null)
    {
        if ($eventId) {
            $event = Event::findOrFail($eventId);
            $this->eventId = $event->id;
            $this->name = $event->name;
            $this->type = $event->type;
            $this->description = $event->description;
            $this->start_time = $event->start_time;
            $this->end_time = $event->end_time;
            $this->location = $event->location;
            $this->is_verified = (bool) $event->is_verified; // <-- force boolean
            $this->mode = 'edit';
        } else {
            $this->reset(['eventId', 'name', 'type', 'description', 'start_time', 'end_time', 'location', 'is_verified']);
            $this->mode = 'create';
        }
        $this->showModal = true;
    }

    public function hide()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();

        if ($this->mode === 'edit') {
            $event = Event::findOrFail($this->eventId);
            $event->update([
                'name' => $this->name,
                'type' => $this->type,
                'description' => $this->description,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'location' => $this->location,
                'is_verified' => $this->is_verified,
            ]);
        } else {
            Event::create([
                'name' => $this->name,
                'type' => $this->type,
                'description' => $this->description,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'location' => $this->location,
                'is_verified' => $this->is_verified,
                'user_id' => Auth::id(),
            ]);
        }

        $this->dispatch('eventSaved');
        $this->hide();
    }

    public function render()
    {
        return view('livewire.events.form', [
            'types' => EventType::cases(),
        ]);
    }
}
