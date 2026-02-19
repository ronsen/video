<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		if (config('database.default') === 'sqlite') {
			DB::statement('PRAGMA busy_timeout = 10000');
			DB::statement('PRAGMA journal_mode = WAL');
			DB::statement('PRAGMA journal_size_limit = 200000000');
			DB::statement('PRAGMA synchronous = NORMAL');
			DB::statement('PRAGMA foreign_keys = ON');
			DB::statement('PRAGMA temp_store = MEMORY');
			DB::statement('PRAGMA cache_size = -32000');
		}
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		DB::prohibitDestructiveCommands(app()->isProduction());

		if (App::isProduction()) {
			URL::forceScheme('https');
		}

		Paginator::useTailwind();
	}
}
