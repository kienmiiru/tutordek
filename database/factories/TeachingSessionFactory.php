<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\TeachingSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeachingSessionFactory extends Factory
{
    protected $model = TeachingSession::class;

    public function definition(): array
    {
        return [
            'student_id' => User::factory()->student(),
            'tutor_id' => User::factory()->tutor(),
            'subject_id' => Subject::factory(),
            'scheduled_at' => fake()->dateTimeBetween('now', '+2 weeks'),
            'price' => fake()->numberBetween(20, 100),
            'status' => fake()->randomElement([
                TeachingSession::STATUS_PENDING_PAYMENT,
                TeachingSession::STATUS_AWAITING_VERIFICATION,
                TeachingSession::STATUS_CONFIRMED,
                TeachingSession::STATUS_COMPLETED,
                TeachingSession::STATUS_REJECTED,
            ]),
            'meeting_link' => fake()->url(),
        ];
    }

    public function pendingPayment()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TeachingSession::STATUS_PENDING_PAYMENT,
        ]);
    }

    public function awaitingVerification()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TeachingSession::STATUS_AWAITING_VERIFICATION,
        ]);
    }

    public function confirmed()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TeachingSession::STATUS_CONFIRMED,
        ]);
    }

    public function completed()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TeachingSession::STATUS_COMPLETED,
        ]);
    }

    public function rejected()
    {
        return $this->state(fn (array $attributes) => [
            'status' => TeachingSession::STATUS_REJECTED,
        ]);
    }
} 