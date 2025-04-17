<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['application_id', 'admin_id', 'comment'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
