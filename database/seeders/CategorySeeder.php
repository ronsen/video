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
		Category::create(
			[
				'name' => 'Music',
				'slug' => 'music',
			],
			[
				'name' => 'Gaming',
				'slug' => 'gaming',
			],
			[
				'name' => 'Education',
				'slug' => 'education',
			],
			[
				'name' => 'Technology',
				'slug' => 'technology',
			],
			[
				'name' => 'Entertainment',
				'slug' => 'entertainment',
			],
			[
				'name' => 'Sports',
				'slug' => 'sports',
			],
			[
				'name' => 'News & Politics',
				'slug' => 'news-politics',
			],
			[
				'name' => 'Science & Nature',
				'slug' => 'science-nature',
			],
			[
				'name' => 'Lifestyle',
				'slug' => 'lifestyle',
			]
		);
	}
}
