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
    public $type = 'all_types'; // default type
    public $showModal = false;
    public $mode = 'create';

    public $fields = [];

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

    public function mount()
    {
        $this->fields = $this->getFormFields($this->type);
    }

    protected function getFormFields($type)
    {
        return match ($type) {
            'user' => [
                ['name' => 'full_name', 'label' => 'Full Name', 'type' => 'text'],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
                ['name' => 'phone', 'label' => 'Phone Number', 'type' => 'tel'],
                ['name' => 'bio', 'label' => 'Short Bio', 'type' => 'textarea'],
                ['name' => 'gender', 'label' => 'Gender', 'type' => 'radio', 'options' => ['Male', 'Female', 'Other']],
                ['name' => 'skills', 'label' => 'Skills', 'type' => 'checkbox', 'options' => ['PHP', 'Vue', 'Livewire']],
                ['name' => 'country', 'label' => 'Country', 'type' => 'select', 'options' => ['Malaysia', 'Singapore', 'Thailand']],
                ['name' => 'dob', 'label' => 'Date of Birth', 'type' => 'date'],
                ['name' => 'website', 'label' => 'Website', 'type' => 'url'],
                ['name' => 'resume', 'label' => 'Resume (PDF)', 'type' => 'file'],
                ['name' => 'motivation', 'label' => 'Why do you want to join?', 'type' => 'textarea'],
            ],
            'vendor' => [
                ['name' => 'company_name', 'label' => 'Company Name', 'type' => 'text'],
                ['name' => 'proposal_file', 'label' => 'Proposal File', 'type' => 'file'],
                ['name' => 'event_id', 'label' => 'Event', 'type' => 'select', 'options' => Event::pluck('name', 'id')->toArray()],
            ],
            'collaborator' => [
                ['name' => 'portfolio_url', 'label' => 'Portfolio URL', 'type' => 'url'],
                ['name' => 'specialty', 'label' => 'Specialty', 'type' => 'text'],
            ],
            'event' => [
                ['name' => 'title', 'label' => 'Title', 'type' => 'text'],
                ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
                ['name' => 'start_date', 'label' => 'Event Start Date', 'type' => 'date'],
                ['name' => 'end_date', 'label' => 'Event End Date', 'type' => 'date'],
                ['name' => 'location', 'label' => 'Location', 'type' => 'text'],
            ],
            'all_types' => [
                ['name' => 'text_field', 'label' => 'Text', 'type' => 'text'],
                ['name' => 'email_field', 'label' => 'Email', 'type' => 'email'],
                ['name' => 'phone_field', 'label' => 'Phone', 'type' => 'tel'],
                ['name' => 'textarea_field', 'label' => 'Textarea', 'type' => 'textarea'],
                ['name' => 'select_field', 'label' => 'Select', 'type' => 'select', 'options' => ['option1' => 'Option 1', 'option2' => 'Option 2']],
                ['name' => 'radio_field', 'label' => 'Radio', 'type' => 'radio', 'options' => ['a' => 'A', 'b' => 'B']],
                ['name' => 'checkbox_field', 'label' => 'Checkbox', 'type' => 'checkbox', 'options' => ['x' => 'X', 'y' => 'Y']],
                ['name' => 'date_field', 'label' => 'Date', 'type' => 'date'],
                ['name' => 'datetime_field', 'label' => 'Date & Time', 'type' => 'datetime-local'],
                ['name' => 'url_field', 'label' => 'URL', 'type' => 'url'],
                ['name' => 'file_field', 'label' => 'Upload File', 'type' => 'file', 'accept' => '*'],
                ['name' => 'image_field', 'label' => 'Upload Image', 'type' => 'image', 'accept' => 'image/*'],
            ],
            default => [],
        };
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
        $this->fields = $this->getFormFields($this->type);
        $this->showModal = true;
    }

    public function hide()
    {
        $this->showModal = false;
    }

    public function save()
    {
        // $this->validate();

        // Generate a unique 5-digit ID using current time and random number
        $uniqueId = time() . rand(10000, 99999);

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
                'title' => $this->type . '-' . $uniqueId,
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
        return view('livewire.applications.form', [
            'fields' => $this->fields,
        ]);
    }
}
