<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;
use App\Models\Tag;

class TagController extends Controller
{
	const PER_PAGE = 10;

	public function show(string $slug): Response
	{
		$tag = Cache::rememberForever("TAG_{$slug}", function () use ($slug) {
			return Tag::where('slug', $slug)->first();
		});

		$posts = Post::with('tags')
			->whereHas('tags', function (Builder $q) use ($tag) {
				$q->where('tag_id', $tag->id);
			})
			->where('user_id', Auth::user()->id)
			->orderBy('id', 'desc')
			->simplePaginate(self::PER_PAGE);

		return Inertia::render('Tags/Show', [
			'slug' => $slug,
			'posts' => $posts,
		]);
	}
}
