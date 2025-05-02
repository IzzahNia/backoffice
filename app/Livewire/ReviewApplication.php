<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Application;
use App\Models\ApplicationReview;
use App\Models\Event;

class ReviewApplication extends Component
{
    public Application $application;
    public array $fields = [];
    public string $status = '';
    public string $reviewNote = '';
    public Event $event;

    public function mount(Application $application)
    {
        $this->application = $application;
        $this->fields = $this->resolveFields($application->type);
        if ($application->event) {
            $this->event = $application->event;
        }
    }

    protected function resolveFields(string $type): array
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

            default => [],
        };
    }

    public function submitReview()
    {
        $this->validate([
            'status' => 'required|in:approved,rejected',
            'reviewNote' => 'nullable|string|max:1000',
        ]);

        ApplicationReview::create([
            'application_id' => $this->application->id,
            'status' => $this->status,
            'note' => $this->reviewNote,
            'reviewed_by' => auth()->id(),
        ]);

        $this->application->update(['status' => $this->status]);

        session()->flash('success', 'Review submitted successfully!');
        return redirect()->route('review');
    }

    public function render()
    {
        return view('livewire.review-application');
    }
}
