<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'project' => $this->faker->sentence(4),
            'tech_stack' => $this->faker->randomElement(["Front End", "Back End", "Full Stack", "Design"]),
            'live_link' => $this->faker->url(),
            'github_link' => $this->faker->url(),
            'project_cover' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph()
        ];
    }
}
