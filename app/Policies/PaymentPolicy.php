<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Payment $payment)
    {
        return $user->id === $payment->teachingSession->student_id;
    }

    public function update(User $user, Payment $payment)
    {
        return $user->id === $payment->teachingSession->student_id;
    }
} 