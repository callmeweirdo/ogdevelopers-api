<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Home>
 */
class HomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_id = Auth::id();
        // dd($user_id);
        return [
            "user_id" => $this->faker->unique()->numberBetween(1, 10),
            'home_welcome' => $this->faker->sentence(7),
            'home_title' => $this->faker->sentence(10),
            'home_description' => $this->faker->paragraph(),
            'about_title' => $this->faker->sentence(10),
            'about_description' => $this->faker->paragraph()
        ];
    }
}
