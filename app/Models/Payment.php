<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'teaching_session_id',
        'payment_proof_path',
        'verified_by',
        'verified_at',
        'status',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function teachingSession()
    {
        return $this->belongsTo(TeachingSession::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
} 