<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StoreController::class, 'index']);
Route::resource('store/posts', StoreController::class)->except(['index']);
Route::get('store/categories/{category}/posts', [StoreController::class, 'getPosts']);
Route::get('store/search', [StoreController::class, 'getSearch']);
Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
