<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'skill' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement(["Front End", "Back End", "Graphics", "UI/UX", "Product Designer"]),
            "experience" => (string)$this->faker->numberBetween(1, 10),
            'logo' => $this->faker->imageUrl()
        ];
    }
}
