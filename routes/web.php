<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])
	->middleware('guest')
	->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])
	->middleware('auth')
	->name('logout');

Route::get('/oauth', [\App\Http\Controllers\Auth\OAuthController::class, 'index'])
	->name('oauth.index');
Route::get('/oauth/callback', [\App\Http\Controllers\Auth\OAuthController::class, 'callback'])
	->name('oauth.callback');

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])
	->name('searches.index');

Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])
	->name('categories.show');
Route::get('/v/{id}/{slug}', [\App\Http\Controllers\PostController::class, 'show'])
	->name('videos.show');

Route::get('/user/{id}/{slug}', [\App\Http\Controllers\UserController::class, 'show'])
	->name('users.show');

Route::middleware('auth')->group(function () {
	Route::resource('/posts', \App\Http\Controllers\PostController::class)->except('show');
});
