<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Utils\YoutubeUtil;

class Post extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'user_id',
		'url',
		'title',
		'content',
		'private',
		'watched',
	];

	protected $appends = [
		'slug',
		'content_to_html',
		'video_html',
		'thumbnail_url',
		'high_thumbnail_url',
		'category',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class)->withTimestamps();
	}

	public function scopeIsPublic(Builder $query): void
	{
		$query->where('private', false);
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
