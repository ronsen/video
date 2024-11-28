<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// \App\Models\User::factory(10)->create();

		User::factory()->create([
			'name' => 'Administrator',
			'email' => 'admin@example.com',
		]);
		
		Tag::factory(10)->create();

		$posts = Post::factory(100)->create();

		foreach ($posts as $post) {
			$tags = Tag::inRandomOrder()->limit(rand(2, 3))->get()->pluck('id');
			$post->tags()->attach($tags);
		}
	}
}
