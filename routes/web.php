<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', function() { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/posts', [PostController::class, 'index'])->name('index');
Route::get('/posts/create', [PostController::class, 'create'])->name('create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Edit Post Route
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('edit')->middleware('auth');

// Update Post Route (assuming you need this for form submission in edit view)
Route::patch('/posts/update/{id}', [PostController::class, 'update'])->name('update')->middleware('auth');

// Destroy/Delete Post Route
Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->name('delete')->middleware('auth');

Route::post('/posts/{post}/likes', [PostController::class, 'like'])->name('posts.like')->middleware('auth');
Route::post('/posts/{post}/replies', [PostController::class, 'reply'])->name('posts.reply')->middleware('auth');

// Viewing the user profile
Route::get('/user/profile', [UserController::class, 'show'])->name('user.profile')->middleware('auth');

// Editing the user profile
Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/profile/update', [UserController::class, 'update'])->name('user.update')->middleware('auth');

