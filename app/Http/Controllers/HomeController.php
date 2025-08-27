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

class HomeController extends Controller
{
	const PER_PAGE = 9;

	public function __construct(public CategoryRepository $categoryRepository) {}

	public function index(Request $request): Response
	{
		$page = $request->input('page') ?? 1;

		$posts = Cache::remember("posts_{$page}", now()->addMinutes(10), function () {
			return Post::with('user')
				->isPublic()
				->orderBy('id', 'desc')
				->simplePaginate(self::PER_PAGE)
				->withQueryString();
		});

		return Inertia::render('Index', [
			'categories' => $this->categoryRepository->getCategories(),
			'posts' => $posts,
		]);
	}
}
