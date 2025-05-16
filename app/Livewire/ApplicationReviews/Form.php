<?php

namespace App\Livewire\ApplicationReviews;

use Livewire\Component;
use App\Models\ApplicationReview;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $reviewId;
    public $application_id = '';
    public $admin_id = '';
    public $comment = '';
    public $showModal = false;
    public $mode = 'create';

    protected $listeners = ['showReviewForm' => 'show', 'hideReviewForm' => 'hide'];

    protected function rules()
    {
        return [
            'application_id' => 'required|exists:applications,id',
            'admin_id' => 'required|exists:users,id',
            'comment' => 'required|string',
        ];
    }

    public function show($reviewId = null)
    {
        if ($reviewId) {
            $review = ApplicationReview::findOrFail($reviewId);
            $this->reviewId = $review->id;
            $this->application_id = $review->application_id;
            $this->admin_id = $review->admin_id;
            $this->comment = $review->comment;
            $this->mode = 'edit';
        } else {
            $this->reset(['reviewId', 'application_id', 'admin_id', 'comment']);
            $this->admin_id = Auth::id();
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
            $review = ApplicationReview::findOrFail($this->reviewId);
            $review->update([
                'application_id' => $this->application_id,
                'admin_id' => $this->admin_id,
                'comment' => $this->comment,
            ]);
        } else {
            ApplicationReview::create([
                'application_id' => $this->application_id,
                'admin_id' => $this->admin_id,
                'comment' => $this->comment,
            ]);
        }

        $this->dispatch('reviewSaved');
        $this->hide();
    }

    public function render()
    {
        $applications = Application::pluck('title', 'id');
        $admins = User::where('role', 'admin')->pluck('name', 'id');
        return view('livewire.applicationReviews.form', [
            'applications' => $applications,
            'admins' => $admins,
        ]);
    }
}
