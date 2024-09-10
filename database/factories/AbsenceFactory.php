<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => 2,
            'date_permission' => $this->faker->date(),
            'reason' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'is_approved' => $this->faker->boolean(),
        ];
    }
}
