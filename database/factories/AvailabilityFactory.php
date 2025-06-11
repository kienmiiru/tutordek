<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailabilityFactory extends Factory
{
    protected $model = Availability::class;

    public function definition(): array
    {
        $startHour = fake()->numberBetween(8, 16);
        $endHour = $startHour + fake()->numberBetween(1, 4);

        return [
            'tutor_id' => User::factory()->tutor(),
            'subject_id' => Subject::factory(),
            'day_of_week' => fake()->randomElement(Availability::DAYS_OF_WEEK),
            'start_time' => sprintf('%02d:00:00', $startHour),
            'end_time' => sprintf('%02d:00:00', $endHour),
            'price' => fake()->numberBetween(20, 100),
        ];
    }
} 