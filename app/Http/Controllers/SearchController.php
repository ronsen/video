<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoryRepository;

class SearchController extends Controller
{
	const PER_PAGE = 9;

	public function __construct(public CategoryRepository $categoryRepository) {}

	public function index(Request $request): Response
	{
		$page = $request->input('page') ?? 1;
		$q = $request->input('q');
		$slug = Str::slug($q);

		$posts = Cache::remember("search_posts_{$slug}_{$page}", now()->addMinutes(10), function () use ($q) {
			return Post::with('user')
				->isPublic()
				->where('title', 'LIKE', "%{$q}%")
				->orderBy('id', 'desc')
				->simplePaginate(self::PER_PAGE)
				->withQueryString();
		});

		return Inertia::render('Search', [
			'categories' => $this->categoryRepository->getCategories(),
			'q' => $request->q,
			'posts' => $posts,
		]);
	}
}
