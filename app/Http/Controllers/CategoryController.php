<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
	const PER_PAGE = 9;

	public function __construct(public CategoryRepository $categoryRepository) {}

	public function show(string $slug, Request $request): Response
	{
		$page = $request->input('page') ?? 1;

		$category = Cache::rememberForever("category_{$slug}", function () use ($slug) {
			return Category::where('slug', $slug)->first();
		});

		if (!$category) {
			abort(404);
		}

		$posts = Cache::remember("category_{$category->id}_posts_{$page}", now()->addMinutes(10), function () use ($category) {
			return Post::with('categories', 'user')
				->isPublic()
				->whereHas('categories', function (Builder $q) use ($category) {
					$q->where('category_id', $category->id);
				})
				->orderBy('id', 'desc')
				->simplePaginate(self::PER_PAGE);
		});

		return Inertia::render('Categories/Show', [
			'categories' => $this->categoryRepository->getCategories(),
			'category' => $category,
			'posts' => $posts,
		]);
	}
}
