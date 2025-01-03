<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
	public function create(): Response
	{
		return Inertia::render('Posts/Create');
	}

	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'url' => ['required', 'url'],
			'title' => ['required'],
		]);

		$post = Post::create([
			'user_id' => Auth::user()->id,
			'url' => $request->input('url'),
			'title' => $request->input('title'),
			'content' => $request->input('content'),
		]);

		if ($request->input('tags')) {
			$post->tags()->sync(Tag::getTagIds(explode(',', $request->input('tags'))));
		}

		return to_route('videos.show', [$post->id, $post->slug]);
	}

	public function edit(Post $post): Response
	{
		Gate::authorize('update', $post);

		return Inertia::render('Posts/Edit', ['post' => $post]);
	}

	public function update(Post $post, Request $request): RedirectResponse
	{
		Gate::authorize('update', $post);

		$request->validate([
			'url' => ['required', 'url'],
			'title' => ['required'],
		]);

		$post->url = $request->input('url');
		$post->title = $request->input('title');
		$post->content = $request->input('content');
		$post->update();

		if ($request->input('tags')) {
			$post->tags()->sync(Tag::getTagIds(explode(',', $request->input('tags'))));
		}

		return back()->with('message', "<strong>{$post->title}</strong> has been updated.");
	}

	public function show(int $id, string $slug): Response|RedirectResponse
	{
		$post = Post::with('tags')->findOrFail($id);

		Gate::authorize('show', $post);

		if ($post->slug != $slug) {
			return redirect()->route('videos.show', [$post->id, $post->slug]);
		}

		return Inertia::render('Posts/Show', ['post' => $post]);
	}

	public function destroy(Post $post): RedirectResponse
	{
		Gate::authorize('delete', $post);

		Session::flash('message', "<strong>{$post->title}</strong> has been deleted.");

		$post->delete();

		return to_route('home');
	}
}
