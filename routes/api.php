<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserCommentController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/profile', [AuthController::class, 'updateProfile']);
    Route::middleware('auth:api')->group(function () {
    Route::post('/profile', [AuthController::class, 'updateProfile']);
    });
});
Route::group(['middleware' => 'auth:api', 'prefix' => 'post'], function () {
    Route::get('/index', [PostController::class, 'index']);
    Route::post('/store', [PostController::class, 'store']);
    Route::put('/update/{id}', [PostController::class, 'update']);
    Route::delete('/delete/{id}', [PostController::class, 'destroy']);
});
Route::group(['middleware' => 'auth:api', 'prefix' => 'comment'], function () {
    Route::post('comments', [CommentController::class, 'store']);
    Route::put('update/{id}', [CommentController::class, 'update']);
    Route::delete('delete/{id}', [CommentController::class, 'destroy']);
});
Route::group(['middleware' => 'auth:api', 'prefix' => 'user-comment'], function () {
    Route::post('comments', [UserCommentController::class, 'store']);
    
});