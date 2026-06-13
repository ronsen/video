<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[UseFactory(UserFactory::class)]
#[Fillable([
	'name',
	'email',
	'password',
])]
#[Appends(['slug'])]
#[Hidden([
	'password',
	'remember_token',
])]
class User extends Authenticatable implements FilamentUser
{
	use Notifiable;

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	public function canAccessPanel(Panel $panel): bool
	{
		return $this->id == 1;
	}

	public function posts(): HasMany
	{
		return $this->hasMany(Post::class);
	}


	public function slug(): Attribute
	{
		return new Attribute(
			get: fn() => Str::slug($this->name)
		);
	}
}
