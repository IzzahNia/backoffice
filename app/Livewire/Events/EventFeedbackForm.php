<?php
namespace App\Livewire\Events;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventFeedback;
use Illuminate\Support\Facades\Auth;

class EventFeedbackForm extends Component
{
    public $event;
    public $name = '';
    public $email = '';
    public $feedback = '';
    public $rating = 5;
    public $submitted = false;

    public function mount(\App\Models\Event $event)
    {
        $this->event = $event;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'feedback' => 'required|string|min:5',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        EventFeedback::create([
            'event_id' => $this->event->id,
            'name' => $this->name,
            'email' => $this->email,
            'feedback' => $this->feedback,
            'rating' => $this->rating,
        ]);

        session()->flash('success', 'Thank you for your feedback!');
        $this->reset(['name', 'email', 'feedback', 'rating']);
        $this->submitted = true;
    }

    public function render()
    {
         if (Auth::check()) {
            return view('livewire.events.event-feedback-form')
            ->layout('layouts.app');
        } else {
            return view('livewire.events.event-feedback-form')
            ->layout('layouts.guest');
        }
    }
}
