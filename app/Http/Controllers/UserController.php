<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
	const PER_PAGE = 9;

	public function show(int $id, string $slug, Request $request): Response|RedirectResponse
	{
		$page = $request->input('page') ?? 1;

		$user = User::findOrFail($id);

		if ($user->slug != $slug) {
			return redirect()->route('users.show', [$user->id, $user->slug]);
		}

		$owner = Auth::check() ? Auth::user()->id == $user->id : false;

		$posts = Cache::remember("user_{$user->id}_posts_{$page}", now()->addMinutes(10), function () use ($owner, $user) {
			return Post::with('categories', 'user')
				->when(!$owner, function (Builder $q) {
					$q->isPublic();
				})
				->where('user_id', $user->id)
				->orderBy('id', 'desc')
				->simplePaginate(self::PER_PAGE)
				->withQueryString();
		});

		return Inertia::render('Users/Show', [
			'posts' => $posts,
			'user' => $user,
		]);
	}
}
