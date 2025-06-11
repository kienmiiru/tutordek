<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition(): array
    {
        $subjects = [
            'Matematika',
            'Fisika',
            'Kimia',
            'Biologi',
            'Bahasa Inggris',
            'Sejarah',
            'Geografi',
            'Informatika',
            'Ekonomi',
            'Psikologi',
            'Sosiologi',
            'Bahasa Indonesia',
            'Seni Budaya',
            'Bahasa Arab',
            'Matematika',
        ];

        return [
            'name' => fake()->unique()->randomElement($subjects),
            'description' => fake()->paragraph(),
        ];
    }
} 