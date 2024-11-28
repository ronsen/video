<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Tag extends Model
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

	public static function findByName(string $name): ?Tag
	{
		return Tag::where('name', $name)->first();
	}

	public static function findBySlug(string $name): ?Tag
	{
		return Tag::where('slug', Str::slug($name))->first();
	}

	public static function findOrCreate(string $name): Tag
	{
		$name = Str::of($name)->trim()->lower();

		$tag = Tag::findBySlug($name);

		if (!$tag) {
			$tag = Tag::create([
				'name' => $name,
				'slug' => Str::slug($name),
				'featured' => false,
			]);
		}

		return $tag;
	}

	public static function getTagIds(?array $names): array
	{
		$tagids = [];

		if ($names) {
			foreach ($names as $name) {
				if ($name) {
					$tag = Tag::findOrCreate($name);
					$tagids[] = $tag->id;
				}
			}
		}

		return $tagids;
	}
}
