<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $classroomIds = Classroom::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        return [
            'name' => fake()->name(),
            'photo' => fake()->imageUrl(),
            'classroom_id' => fake()->randomElement($classroomIds),
            'created_by' => fake()->randomElement($userIds),
            'updated_by' => fake()->randomElement($userIds),
        ];
    }
}
