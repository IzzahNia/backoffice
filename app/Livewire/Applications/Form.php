<?php

namespace App\Livewire\Applications;

use App\Models\Application;
use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $applicationId;
    public $title = '';
    public $description = '';
    public $event_id = '';
    public $status = 'pending';
    public $type = '';
    public $showModal = false;
    public $mode = 'create';

    protected $listeners = ['showApplicationForm' => 'show', 'hideApplicationForm' => 'hide'];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_id' => 'nullable|exists:events,id',
            'status' => 'required|in:pending,approved,rejected',
            'type' => 'required|in:user,vendor,collaborator,event,crew',
        ];
    }

    public function show($applicationId = null)
    {
        if ($applicationId) {
            $application = Application::findOrFail($applicationId);
            $this->applicationId = $application->id;
            $this->title = $application->title;
            $this->description = $application->description;
            $this->event_id = $application->event_id;
            $this->status = $application->status;
            $this->type = $application->type;
            $this->mode = 'edit';
        } else {
            $this->reset(['applicationId', 'title', 'description', 'event_id', 'status', 'type']);
            $this->status = 'pending';
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
            $application = Application::findOrFail($this->applicationId);
            $application->update([
                'title' => $this->title,
                'description' => $this->description,
                'event_id' => $this->event_id,
                'status' => $this->status,
                'type' => $this->type,
            ]);
        } else {
            Application::create([
                'title' => $this->title,
                'description' => $this->description,
                'event_id' => $this->event_id,
                'user_id' => Auth::id(),
                'status' => $this->status,
                'type' => $this->type,
                'data' => [],
            ]);
        }

        $this->dispatch('applicationSaved');
        $this->hide();
    }

    public function render()
    {
        $events = Event::pluck('name', 'id');
        return view('livewire.applications.form', [
            'events' => $events,
        ]);
    }
}
