<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class CategoryObserver
{
    public function created(): void
    {
        Cache::forget('categories');
    }

    public function updated(Category $category): void
    {
		Cache::forget('categories');
        Cache::forget("category_{$category->slug}");
    }

    public function deleted(Category $category): void
    {
		Cache::forget('categories');
        Cache::forget("category_{$category->slug}");
    }
}
