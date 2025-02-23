<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
	const PER_PAGE = 9;

	public function index(Request $request): Response
	{
		$page = $request->input('page') ?? 1;

		$posts = Cache::remember("posts_{$page}", now()->addMinutes(10), function () use ($request) {
			return Post::with('user')
				->isPublic()
				->when($request->q, function (Builder $q) use ($request) {
					$q->where('title', 'LIKE', "%{$request->q}%");
				})
				->orderBy('id', 'desc')
				->simplePaginate(self::PER_PAGE)
				->withQueryString();
		});

		$categories = Cache::rememberForever('categories', function () {
			return Category::orderBy('name', 'asc')->get();
		});

		return Inertia::render('Index', [
			'q' => $request->q,
			'posts' => $posts,
			'categories' => $categories,
		]);
	}
}
