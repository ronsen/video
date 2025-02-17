<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;

class HomeController extends Controller
{
	const PER_PAGE = 9;

	public function index(Request $request): Response
	{
		if (Auth::check()) {
			$posts = Post::with('tags')
				->when($request->q, function ($q) use ($request) {
					$q->where('title', 'LIKE', "%{$request->q}%");
				})
				->where('user_id', Auth::user()->id)
				->orderBy('id', 'desc')
				->simplePaginate(self::PER_PAGE)
				->withQueryString();

			return Inertia::render('Posts/Index', [
				'q' => $request->q,
				'posts' => $posts,
			]);
		} else {
			return Inertia::render('Auth/Login', [
				'title' => 'Video',
			]);
		}
	}
}
