<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::controller(PostController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/posts/{slug}', 'details')->name('details');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', IsAdmin::class])->name('dashboard');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'categories' => CategoryController::class,
        'posts' => PostController::class,
    ]);
});

require __DIR__.'/auth.php';
