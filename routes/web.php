<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\CommentController;
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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('home');
});
Route::resource('posts',PostController::class)->middleware('auth');
Route::get('post/deleted', [PostController::class, 'deletedPosts'])->name('posts.deleted')->middleware('auth');
Route::delete('post/deleted/{id}',[PostController::class, 'forceDelete'])->name('posts.forceDelete')->middleware('auth');
Route::get('post/restore/one/{id}', [PostController::class, 'restore'])->name('posts.restore')->middleware('auth');
Route::get('restoreAll', [PostController::class, 'restoreAll'])->name('posts.restore.all')->middleware('auth');

Route::resource('comments',CommentController::class);
Route::get('/users',[userController::class,'index']);
Route::get('/users/{id}',[userController::class,'show'])->name('users.show');

Auth::routes();

