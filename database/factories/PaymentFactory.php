<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\TeachingSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'teaching_session_id' => TeachingSession::factory(),
            'payment_proof_path' => 'payments/' . fake()->uuid() . '.jpg',
            'verified_by' => User::factory(),
            'verified_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'status' => fake()->randomElement([
                Payment::STATUS_PENDING,
                Payment::STATUS_VERIFIED,
                Payment::STATUS_REJECTED,
            ]),
        ];
    }

    public function pending()
    {
        return $this->state(fn (array $attributes) => [
            'status' => Payment::STATUS_PENDING,
            'verified_by' => null,
            'verified_at' => null,
        ]);
    }

    public function verified()
    {
        return $this->state(fn (array $attributes) => [
            'status' => Payment::STATUS_VERIFIED,
            'verified_at' => now(),
        ]);
    }

    public function rejected()
    {
        return $this->state(fn (array $attributes) => [
            'status' => Payment::STATUS_REJECTED,
            'verified_at' => now(),
        ]);
    }
} 