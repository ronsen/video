<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;

class HomeController extends Controller
{
	const PER_PAGE = 10;

	public function index(Request $request): Response
	{
		$posts = Post::when($request->q, function ($q) use ($request) {
			return $q->where('title', 'LIKE', "%{$request->q}%");
		})
			->where('user_id', Auth::user()->id)
			->orderBy('id', 'desc')
			->simplePaginate(self::PER_PAGE)
			->withQueryString();

		return Inertia::render('Posts/Index', [
			'q' => $request->q,
			'posts' => $posts,
		]);
	}
}
