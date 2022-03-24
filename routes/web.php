<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', 'HomeController@index');

Auth::routes();

// Admin routes group
Route::middleware('auth')
    ->namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get("posts/archivedPosts", "PostController@archivedPosts")->name('posts.archivedPosts');
        Route::get("posts/archive", "PostController@archive")->name('posts.archive');
        Route::resource("posts", "PostController");
        Route::resource("users", "UserController");
    });

    Route::get("{any?}", function() {
        return view("vueHome");
    })->where("any", ".*");