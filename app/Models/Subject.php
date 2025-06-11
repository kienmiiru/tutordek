<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function teachingSessions()
    {
        return $this->hasMany(TeachingSession::class);
    }
} 