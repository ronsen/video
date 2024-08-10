<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'user_id' => User::inRandomOrder()->first()->id,
			'url' => 'https://www.youtube.com/watch?v=jNQXAC9IVRw', // Me at the zoo
			'title' => ucwords(fake()->words(5, true)),
			'content' => fake()->realText(),
		];
	}
}
