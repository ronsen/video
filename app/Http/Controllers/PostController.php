<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;

class PostController extends Controller
{
	public function create(): Response
	{
		return Inertia::render('Posts/Create');
	}

	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'url' => 'required',
			'title' => 'required',
		]);

		$post = Post::create([
			'user_id' => auth()->user()->id,
			'url' => $request->url,
			'title' => $request->title,
			'content' => $request->content,
		]);

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
			'url' => 'required',
			'title' => 'required',
		]);

		$post->url = $request->url;
		$post->title = $request->title;
		$post->content = $request->content;
		$post->update();

		return back()->with('message', "<strong>{$post->title}</strong> has been updated.");
	}

	public function show(int $id, string $slug): Response|RedirectResponse
	{
		$post = Post::findOrFail($id);

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
