<?php

namespace Database\Factories;

use App\Models\TutorProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorProfileFactory extends Factory
{
    protected $model = TutorProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->tutor(),
            'bio' => fake()->paragraphs(2, true),
        ];
    }
} 