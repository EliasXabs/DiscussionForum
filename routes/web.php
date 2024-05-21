<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
// Register
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
// Login
Route::get('login', function() { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);


// User middleware
Route::middleware(['auth'])->group(function(){

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/posts', [PostController::class, 'index'])->name('index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('edit')->middleware('auth');
    Route::patch('/posts/update/{id}', [PostController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->name('delete')->middleware('auth');

    Route::post('/posts/{post}/likes', [PostController::class, 'like'])->name('posts.like')->middleware('auth');
    Route::post('/posts/{post}/replies', [PostController::class, 'reply'])->name('posts.reply')->middleware('auth');
    Route::delete('/replies/{reply}', [PostController::class, 'destroyReply'])->name('reply.delete');

    Route::get('/user/profile', [UserController::class, 'show'])->name('user.profile')->middleware('auth');
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
    Route::put('/user/profile/update', [UserController::class, 'update'])->name('user.update')->middleware('auth');
});

// Admin middleware
Route::middleware(['auth','admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::post('/admin/users/{user}/toggle', [AdminController::class, 'toggleUser'])->name('admin.users.toggle');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::delete('/admin/replies/{reply}', [AdminController::class, 'deleteReply'])->name('admin.replies.delete');
    Route::get('/admin/post/{post}', [AdminController::class, 'showPost'])->name('admin.post.show');
});