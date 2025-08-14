<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\Post;

class PostObserver
{
	public function created(Post $post): void
	{
		Cache::flush();
	}

	public function updated(Post $post): void
	{
		Cache::flush();
	}

	public function deleted(Post $post): void
	{
		Cache::flush();
	}
}
