<?php

namespace Database\Factories;

use App\Models\AssistantApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssistantApplication>
 */
class AssistantApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_name' => $this->faker->name(),
            'student_id' => $this->faker->unique()->numerify('245150##########'),
            'course_name' => 'Pemrograman Lanjut',
            'gpa' => $this->faker->randomFloat(2, 3, 4),
            'status' => 'pending',
        ];
    }
}
