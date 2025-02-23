<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
	public function create(): Response
	{
		$categories = Cache::rememberForever('categories', function () {
			return Category::orderBy('name', 'asc')->get();
		});
		
		return Inertia::render('Posts/Create', [
			'categories' => $categories,
		]);
	}

	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'url' => ['required', 'url'],
			'title' => ['required'],
			'category' => ['required'],
		]);

		$post = Post::create([
			'user_id' => Auth::user()->id,
			'url' => $request->input('url'),
			'title' => $request->input('title'),
			'content' => $request->input('content'),
			'private' => $request->boolean('private'),
		]);

		$post->categories()->attach($request->input('category'));

		return to_route('videos.show', [$post->id, $post->slug]);
	}

	public function edit(Post $post): Response
	{
		Gate::authorize('update', $post);

		$categories = Cache::rememberForever('categories', function () {
			return Category::orderBy('name', 'asc')->get();
		});

		return Inertia::render('Posts/Edit', [
			'post' => $post,
			'categories' => $categories,
		]);
	}

	public function update(Post $post, Request $request): RedirectResponse
	{
		Gate::authorize('update', $post);

		$request->validate([
			'url' => ['required', 'url'],
			'title' => ['required'],
			'category' => ['required'],
		]);

		$post->url = $request->input('url');
		$post->title = $request->input('title');
		$post->content = $request->input('content');
		$post->private = $request->boolean('private');
		$post->update();

		$post->categories()->sync($request->input('category'));

		return back()->with('message', "<strong>{$post->title}</strong> has been updated.");
	}

	public function show(int $id, string $slug): Response|RedirectResponse
	{
		$post = Post::with('categories', 'user')->findOrFail($id);

		if ($post->private) {
			Gate::authorize('show', $post);
		}

		if ($post->slug != $slug) {
			return redirect()->route('videos.show', [$post->id, $post->slug]);
		}

		$post->increment('watched');

		return Inertia::render('Posts/Show', [
			'post' => $post,
			'owner' => Auth::check() ? Auth::user()->id == $post->user->id : false,
		]);
	}

	public function destroy(Post $post): RedirectResponse
	{
		Gate::authorize('delete', $post);

		Session::flash('message', "<strong>{$post->title}</strong> has been deleted.");

		$post->delete();

		return to_route('home');
	}
}
