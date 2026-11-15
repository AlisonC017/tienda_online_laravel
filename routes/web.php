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

// ---------- SITIO PÚBLICO ----------
// TEMPORAL: sin base de datos todavía. Cuando existan las tablas,
// cambiar esta ruta por: Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('modules.landing.index', [
        'destacadas'  => collect(),
        'masVendidos' => collect(),
        'tiendasTop'  => collect(),
    ]);
})->name('home');

// ---------- ADMIN TIENDAS ----------
// Cuando el Integrante 1 entregue el middleware, agregar ->middleware(['auth', 'rol:admin'])
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('tiendas', [AdminTiendaController::class, 'index'])->name('tiendas.index');
    Route::patch('tiendas/{tienda}/activa', [AdminTiendaController::class, 'toggleActiva'])->name('tiendas.activa');
    Route::patch('tiendas/{tienda}/destacada', [AdminTiendaController::class, 'toggleDestacada'])->name('tiendas.destacada');
});

// ---------- TEMPORALES: borrar cuando los demás integrantes definan las suyas ----------
Route::get('/productos', fn () => 'Pendiente: Integrante 2')->name('productos.index');
Route::get('/productos/{id}', fn ($id) => 'Pendiente: Integrante 2')->name('productos.show');
Route::get('/tiendas', fn () => 'Pendiente: Integrante 2')->name('tiendas.index');
Route::get('/tiendas/{id}', fn ($id) => 'Pendiente: Integrante 2')->name('tiendas.show');
Route::get('/carrito', fn () => 'Pendiente: Integrante 4')->name('carrito.index');