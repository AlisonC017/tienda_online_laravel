<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerNavigation;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ControllerAuth;

Route::get('/', function () {
    return view('modules.landing.index');
});

Route::get('/p', function () {
    return view('modules.landing.productos.index');
});

Route::get('/l', function () {
    return view('login');
});

Route::get('/a', function () {
    return view('modules.admin.index');
});



Route::middleware('auth')->group(function () {


    // rutas para tienda
    Route::middleware('rol:tienda')->group(function () {});

    // rutas  para admin
    Route::middleware('rol:administrador')->group(function () {});
});

Route::get('/login', [ControllerNavigation::class, 'login'])->name('login');
Route::get('/dashboard', [ControllerNavigation::class, 'dashboard'])->name('dashboard')->middleware('auth');

// --- autenticacion  ---
Route::post('/login', [ControllerAuth::class, 'login'])->name('login.post');
Route::post('/register', [ControllerAuth::class, 'register'])->name('register.post');

// --- google ---
Route::get('/auth/google', [ControllerAuth::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [ControllerAuth::class, 'handleGoogleCallback']);
