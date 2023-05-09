<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use \App\Http\Controllers\PostController;
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
Route::resource('posts',PostController::class);
Route::get('/create', function () {
    return view('create');
});
Route::get('/users',[userController::class,'index']);
Route::get('/', function () {
    return view('home');
});