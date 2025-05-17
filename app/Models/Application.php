<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'user_id', 'event_id', 'status', 'type', 'data', 'reviewBy', 'comment'];

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(ApplicationReview::class);
    }

    public function review()
    {
        return $this->hasOne(ApplicationReview::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
