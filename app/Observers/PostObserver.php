<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\Post;

class PostObserver
{
	public function created(Post $post): void
	{
		$this->clear($post);
	}

	public function updated(Post $post): void
	{
		$this->clear($post);
	}

	public function deleted(Post $post): void
	{
		$this->clear($post);
	}

	private function clear(Post $post): void
	{
		Cache::forget("posts_1");

		foreach ($post->categories as $category) {
			Cache::forget("category_{$category->id}_posts_1");
		}

		Cache::forget("user_{$post->user->id}_posts_1");
	}
}
