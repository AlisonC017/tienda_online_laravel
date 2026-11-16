<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerNavigation;
use App\Http\Controllers\ControllerAuth;

// PUBLICO
Route::get('/', function () {
    return view('modules.landing.index');
})->name('inicio');

Route::get('/p', function () {
    return view('modules.landing.productos.index');
})->name('productos.index');

Route::get('/ps/{id}', function ($id) {
    return view('modules.landing.productos.show', compact('id'));
})->name('productos.show');

Route::get('/ti', function () {
    return view('modules.landing.tiendas.index');
})->name('tiendas.index');

Route::get('/ti/{id}', function ($id) {
    return view('modules.landing.tiendas.show', compact('id'));
})->name('tiendas.show');

Route::get('/contacto', function () {
    return view('modules.landing.contacto');
})->name('contacto');

// AUTENTICACION
Route::get('/login', [ControllerNavigation::class, 'login'])->name('login');
Route::post('/login', [ControllerAuth::class, 'login'])->name('login.post');
Route::post('/register', [ControllerAuth::class, 'register'])->name('register.post');

// GOOGLE
Route::get('/auth/google', [ControllerAuth::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [ControllerAuth::class, 'handleGoogleCallback']);

// RUTAS PROTEGIDAS
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [ControllerNavigation::class, 'dashboard'])->name('dashboard');

    // ADMINISTRADOR
    Route::middleware(['rol:administrador'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('modules.admin.index');
        })->name('index');
    });

    // TIENDA
    Route::middleware(['rol:tienda'])->prefix('tienda')->name('tienda.')->group(function () {
        Route::get('/', function () {
            return view('modules.tienda.index');
        })->name('index');
    });

    // CERRAR SESION
    Route::post('/logout', [ControllerAuth::class, 'logout'])->name('logout');
});


// RUTAS DEL MIDDLEWARE ALIIIII


Route::middleware('guest')->group(function () {

    Route::view('/login', 'login')->name('login');
    Route::view('/registro', 'login', ['tab' => 'signup'])->name('register');

    Route::post('/login', [ControllerAuth::class, 'login']);
    Route::post('/registro', [ControllerAuth::class, 'register']);

    Route::get('/auth/google', [ControllerAuth::class, 'redirectGoogle'])->name('google');
    Route::get('/auth/google/callback', [ControllerAuth::class, 'callbackGoogle']);
});
