<?php

namespace App\Policies;

use App\Models\TeachingSession;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeachingSessionPolicy
{
    use HandlesAuthorization;

    public function view(User $user, TeachingSession $session)
    {
        return $user->id === $session->tutor_id || $user->id === $session->student_id;
    }

    public function update(User $user, TeachingSession $session)
    {
        return $user->id === $session->tutor_id;
    }
} 