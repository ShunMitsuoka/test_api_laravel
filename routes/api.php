<?php

use App\Http\Controllers\ArticleApiController;
use App\Http\Controllers\UserApiController;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserApiController::class, 'show']);

Route::get('/article/{id}', [ArticleApiController::class, 'show']);
Route::get('/articles', [ArticleApiController::class, 'index']);
Route::post('/article', [ArticleApiController::class, 'store']);
Route::put('/article/{id}', [ArticleApiController::class, 'update']);
Route::delete('/article/{id}', [ArticleApiController::class, 'delete']);