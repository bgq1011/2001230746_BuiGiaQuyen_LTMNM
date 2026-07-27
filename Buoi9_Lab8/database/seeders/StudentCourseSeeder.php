<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;

class StudentCourseSeeder extends Seeder
{


    public function run(): void
    {
        $courses = Course::factory()->count(3)->create();
        Student::factory()->count(10)->create()->each(function ($student) use ($courses) {

            $student->courses()->attach(
                $courses->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
