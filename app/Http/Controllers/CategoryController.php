<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
	const PER_PAGE = 9;

	public function show(string $slug): Response
	{
		$category = Cache::rememberForever("category_{$slug}", function () use ($slug) {
			return Category::where('slug', $slug)->first();
		});
		
		if (!$category) {
			abort(404);
		}

		$posts = Post::with('categories')
			->whereHas('categories', function (Builder $q) use ($category) {
				$q->where('category_id', $category->id);
			})
			->orderBy('id', 'desc')
			->simplePaginate(self::PER_PAGE);

		return Inertia::render('Categories/Show', [
			'category' => $category,
			'posts' => $posts,
		]);
	}
}
