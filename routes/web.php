<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('auth.register', ['name' => 'Sushant']);
});
Route::post('/register', [UserController::class, 'register']);

Route::view('/login', 'auth.login');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/ram', [UserController::class, 'ram'])->middleware('auth');
