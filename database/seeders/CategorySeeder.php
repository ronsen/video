<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Category::create(['name' => 'Music', 'slug' => 'music']);
		Category::create(['name' => 'Gaming', 'slug' => 'gaming']);
		Category::create(['name' => 'Education', 'slug' => 'education']);
		Category::create(['name' => 'Technology', 'slug' => 'technology']);
		Category::create(['name' => 'Entertainment', 'slug' => 'entertainment']);
		Category::create(['name' => 'Sports', 'slug' => 'sports']);
		Category::create(['name' => 'News & Politics', 'slug' => 'news-politics']);
		Category::create(['name' => 'Science & Nature', 'slug' => 'science-nature']);
		Category::create(['name' => 'Lifestyle', 'slug' => 'lifestyle']);
	}
}
