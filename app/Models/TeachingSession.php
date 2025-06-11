<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingSession extends Model
{
    use HasFactory;

    const STATUS_PENDING_PAYMENT = 'pending_payment';
    const STATUS_AWAITING_VERIFICATION = 'awaiting_verification';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'student_id',
        'tutor_id',
        'subject_id',
        'scheduled_at',
        'price',
        'status',
        'meeting_link',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
} 