<?php

namespace App\Models;

use App\Utils\VideoUtil;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function slug(): Attribute
	{
		return new Attribute(
			get: fn () => Str::slug($this->title)
		);
	}

	public function contentToHtml(): Attribute
	{
		return new Attribute(
			get: fn () => nl2br($this->content)
		);
	}

	public function videoHtml(): Attribute
	{
		return new Attribute(
			get: fn () => VideoUtil::parse($this->url)
		);
	}

	public function thumbnailUrl(): Attribute
	{
		return new Attribute(
			get: fn () => VideoUtil::getYoutubeThumbnailURL($this->url, 'high')
		);
	}
}
