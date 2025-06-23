<?php

use Illuminate\Support\Facades\Route;

Route::get('/title', [\App\Http\Controllers\Api\TitleController::class, 'index']);
