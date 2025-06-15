<?php

namespace App\Policies;

use App\Models\Availability;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvailabilityPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Availability $availability)
    {
        return $user->id === $availability->tutor_id;
    }

    public function delete(User $user, Availability $availability)
    {
        return $user->id === $availability->tutor_id;
    }
} 