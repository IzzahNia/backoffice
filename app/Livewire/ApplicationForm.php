<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Application;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApplicationForm extends Component
{
    use WithFileUploads;

    public $type; // e.g., 'member', 'vendor', 'collaborator'
    public $fields = []; // Config for fields (like label, name, type)
    public $form = [];   // Bound values
    public array $userEvents = [];
    public $selectedEvent = null;

    public function mount($type)
    {
        $this->type = $type;
        $this->fields = $this->getFormFields($type);

        // Fill options dynamically for the event field
        foreach ($this->fields as &$field) {
            if ($field['name'] === 'event_id' && $field['type'] === 'select') {
                $field['options'] = Event::where('user_id', Auth::id())->where('is_verified', 1)->get()->map(fn($event) => ['value' => $event->id, 'label' => $event->name])->toArray();
            }
        }
    }

    protected function getFormFields($type)
    {
        return match ($type) {
            'user' => [
                ['name' => 'full_name', 'label' => 'Full Name', 'type' => 'text'],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
                ['name' => 'phone', 'label' => 'Phone Number', 'type' => 'tel'],
                ['name' => 'resume', 'label' => 'Resume (PDF)', 'type' => 'file'],
                ['name' => 'motivation', 'label' => 'Why do you want to join?', 'type' => 'textarea'],
            ],
            'vendor' => [
                ['name' => 'company_name', 'label' => 'Company Name', 'type' => 'text'],
                ['name' => 'proposal_file', 'label' => 'Proposal File', 'type' => 'file'],
                ['name' => 'event_id', 'label' => 'Event', 'type' => 'select', 'options' => []],
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

            /**
             * TODO: this is an example of a more complex form with various field types.
             * You can use this to create a more dynamic form based on the type.
            **/
            // [
            //     { "name": "full_name", "label": "Full Name", "type": "text" },
            //     { "name": "email", "label": "Email", "type": "email" },
            //     { "name": "phone", "label": "Phone Number", "type": "tel" },
            //     { "name": "bio", "label": "Short Bio", "type": "textarea" },
            //     { "name": "gender", "label": "Gender", "type": "radio", "options": ["Male", "Female", "Other"] },
            //     { "name": "skills", "label": "Skills", "type": "checkbox", "options": ["PHP", "Vue", "Livewire"] },
            //     { "name": "country", "label": "Country", "type": "select", "options": ["Malaysia", "Singapore", "Thailand"] },
            //     { "name": "dob", "label": "Date of Birth", "type": "date" },
            //     { "name": "website", "label": "Website", "type": "url" },
            //     { "name": "resume", "label": "Resume (PDF)", "type": "file" }
            // ]



            default => [],
        };
    }

    public function submit()
    {
        $validated = $this->validateFields();

        $uploaded = [];
        foreach ($this->fields as $field) {
            if ($field['type'] === 'file' && isset($this->form[$field['name']])) {
                $uploaded[$field['name']] = $this->form[$field['name']]->store("applications/{$this->type}", 'public');
            }
            if ($field['type'] === 'select' && $field['name'] === 'event_id') {
                $this->selectedEvent = $this->form[$field['name']];
            }
        }

        Application::create([
            'user_id' => Auth::id(),
            'title' => $this->type . '_' . random_int(1000, 9999),
            'status' => 'pending',
            'type' => $this->type,
            'data' => ['form' => array_merge($validated, $uploaded)] ,
            'event_id' => $this->selectedEvent ?: null,
        ]);

        session()->flash('success', 'Application submitted successfully.');
        return redirect()->route('application');
    }

    protected function validateFields()
    {
        $rules = [];

        foreach ($this->fields as $field) {
            $rules["form.{$field['name']}"] = match ($field['type']) {
                'email' => 'required|email',
                'tel' => 'required|string',
                'file' => 'file|max:2048',
                // 'file' => 'required|file|max:2048',
                'select' => ['required', Rule::in(array_map('strval', array_column($field['options'] ?? [], 'value')))],
                default => 'required|string'
            };
        }

        return $this->validate($rules)['form'];
    }

    public function render()
    {
        return view('livewire.application-form');
    }
}
