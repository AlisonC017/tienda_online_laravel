<?php

use Illuminate\Support\Facades\Route;

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
