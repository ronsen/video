<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory(100)->create();

		foreach ($posts as $post) {
			$categories = Category::inRandomOrder()->limit(rand(2, 3))->get()->pluck('id');
			$post->categories()->attach($categories);
		}
    }
}
