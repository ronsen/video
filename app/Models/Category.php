<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Observers\CategoryObserver;

#[Fillable([
	'name',
	'slug',
])]
#[ObservedBy(CategoryObserver::class)]
class Category extends Model
{
	public function posts(): BelongsToMany
	{
		return $this->belongsToMany(Post::class);
	}
}
