<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Observers\CategoryObserver;

#[ObservedBy(CategoryObserver::class)]
class Category extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'slug',
	];

	public function posts(): BelongsToMany
	{
		return $this->belongsToMany(Post::class);
	}
}
