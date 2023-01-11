<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\LearningStatus;
use App\Enums\PaymentStatus;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
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
        return [
            'name'            => $this->faker->name(),
            'email'           => $this->faker->unique()->safeEmail(),
            'payment_status'  => PaymentStatus::UNPAID->description(),
            'learning_status' => LearningStatus::PENDING->description(),
        ];
    }
}
