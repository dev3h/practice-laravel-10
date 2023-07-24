<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $studentIds = Student::pluck('id')->toArray();
        return [
            'code' => Str::random(20),
            'name' => fake()->name(),
            'student_id' => fake()->randomElement($studentIds)
        ];
    }
}
