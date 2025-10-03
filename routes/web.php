<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('auth.register', ['name' => 'Sushant']);
});

Route::post('/register', [UserController::class, 'register']);

Route::view('/login', 'auth.login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);

Route::get('/ram', [UserController::class, 'ram'])->middleware('auth');

Route::get('/dashboard', [BlogController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard/create', function () {
    return view('blog.create');
})->middleware('auth')->name('blog.create');
Route::post('/dashboard/create', [BlogController::class, 'store'])->middleware('auth')->name('blog.store');
Route::get('/dashboard/{id}/delete', [BlogController::class, 'destroy'])->middleware('auth')->name('blog.destroy');
Route::get('/dashboard/{id}/edit', [BlogController::class, 'edit'])->middleware('auth')->name('blog.edit');
Route::post('/dashboard/{id}/edit', [BlogController::class, 'update'])->middleware('auth')->name('blog.update');
Route::get('/{username}/{slug}', [BlogController::class, 'show'])->name('blog.show');
