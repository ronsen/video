<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Observers\PostObserver;
use App\Utils\YoutubeUtil;

#[UseFactory(PostFactory::class)]
#[Fillable([
	'user_id',
	'url',
	'title',
	'content',
	'private',
	'watched',
])]
#[Appends([
	'slug',
	'content_to_html',
	'video_html',
	'thumbnail_url',
	'high_thumbnail_url',
	'category',
])]
#[ObservedBy(PostObserver::class)]
class Post extends Model
{
	use SoftDeletes;

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class)->withTimestamps();
	}

	#[Scope]
	public function isPublic(Builder $query): Builder
	{
		return $query->where('private', false);
	}

	public function category(): Attribute
	{
		return new Attribute(
			get: fn() => $this->categories->count() == 0 ? 0 : $this->categories->first()->id,
		);
	}

	public function slug(): Attribute
	{
		return new Attribute(
			get: fn() => Str::slug($this->title)
		);
	}

	public function contentToHtml(): Attribute
	{
		return new Attribute(
			get: fn() => nl2br($this->content)
		);
	}

	public function videoHtml(): Attribute
	{
		return new Attribute(
			get: fn() => YoutubeUtil::parse((string) $this->url)
		);
	}

	public function thumbnailUrl(): Attribute
	{
		return new Attribute(
			get: fn() => YoutubeUtil::getThumbnailURL((string) $this->url)
		);
	}

	public function highThumbnailUrl(): Attribute
	{
		return new Attribute(
			get: fn() => YoutubeUtil::getThumbnailURL((string) $this->url, 'high')
		);
	}
}
