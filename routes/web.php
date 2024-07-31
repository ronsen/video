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

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'create'])
	->middleware('guest')
	->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'store']);
Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'destroy'])
	->middleware('auth')
	->name('logout');

Route::get('/oauth', [\App\Http\Controllers\OAuthController::class, 'index'])->name('oauth.index');
Route::get('/oauth/callback', [\App\Http\Controllers\OAuthController::class, 'callback'])->name('oauth.callback');

Route::middleware('auth')->group(function () {
	Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::resource('/posts', \App\Http\Controllers\PostController::class)->except('show');
	Route::get('/video/{id}/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('videos.show');
});
