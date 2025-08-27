<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class CategoryRepository
{
	public function getCategories(): Collection
	{
		return Cache::rememberForever('categories', function () {
			return Category::orderBy('name', 'asc')->get();
		});
	}
}
