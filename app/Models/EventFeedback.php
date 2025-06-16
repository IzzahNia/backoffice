<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventFeedback extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'feedback',
        'rating',
    ];

    // Relationship to Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
