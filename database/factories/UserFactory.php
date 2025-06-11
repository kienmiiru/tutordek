<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement([User::ROLE_STUDENT, User::ROLE_TUTOR]),
        ];
    }

    public function tutor()
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_TUTOR,
        ]);
    }

    public function student()
    {
        return $this->state(fn (array $attributes) => [
            'role' => User::ROLE_STUDENT,
        ]);
    }
}
