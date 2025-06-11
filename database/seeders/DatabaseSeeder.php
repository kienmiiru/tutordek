<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Availability;
use App\Models\Payment;
use App\Models\Subject;
use App\Models\TeachingSession;
use App\Models\TutorProfile;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create subjects
        $subjects = Subject::factory(7)->create();

        // Create tutors with profiles
        $tutors = User::factory(10)->tutor()->create();
        foreach ($tutors as $tutor) {
            TutorProfile::factory()->create(['user_id' => $tutor->id]);
            
            // Create availabilities for each tutor
            foreach ($subjects->random(3) as $subject) {
                Availability::factory(2)->create([
                    'tutor_id' => $tutor->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }

        // Create students
        $students = User::factory(20)->student()->create();

        // Create teaching sessions
        foreach ($students as $student) {
            TeachingSession::factory(3)->create([
                'student_id' => $student->id,
                'tutor_id' => $tutors->random()->id,
                'subject_id' => $subjects->random()->id,
            ]);
        }

        // Create payments for teaching sessions
        TeachingSession::where('status', '!=', TeachingSession::STATUS_PENDING_PAYMENT)
            ->get()
            ->each(function ($session) {
                Payment::factory()->create([
                    'teaching_session_id' => $session->id,
                    'verified_by' => User::factory()->create(),
                ]);
            });
    }
}
