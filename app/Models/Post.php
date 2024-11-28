<?php

namespace App\Models;

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
	];

	protected $appends = [
		'slug',
		'content_to_html',
		'video_html',
		'thumbnail_url',
		'tags_as_csv',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function tags(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class)->withTimestamps();
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
			get: fn() => YoutubeUtil::parse($this->url)
		);
	}

	public function thumbnailUrl(): Attribute
	{
		return new Attribute(
			get: fn() => YoutubeUtil::getThumbnailURL($this->url, 'high')
		);
	}

	public function tagsAsCsv(): Attribute
	{
		return new Attribute(
			get: fn() => $this->tags->pluck('name')->implode(', ')
		);
	}
}
