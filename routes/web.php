<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerNavigation;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoTiendaController;
use App\Http\Controllers\PedidoAdminController;

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

Route::post('/ti/{id}/contacto', function ($id) {
    return redirect()->route('tiendas.show', $id)->with('ok', 'Mensaje enviado a la tienda.');
})->name('tiendas.contacto');

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

        Route::get('/mi-tienda', function () {
            return view('modules.tienda.mi-tienda');
        })->name('mi-tienda');

        Route::put('/mi-tienda', function () {
            return redirect()->route('tienda.mi-tienda')->with('ok', 'Cambios guardados.');
        })->name('mi-tienda.update');
    });

    // ADMINISTRADOR - PEDIDOS
    Route::middleware(['rol:administrador'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/pedidos', [PedidoAdminController::class, 'index'])
            ->name('pedidos.index');

        Route::get('/pedidos/{pedido}', [PedidoAdminController::class, 'show'])
            ->name('pedidos.show');

        Route::patch('/pedidos/{pedido}/entregar', [PedidoAdminController::class, 'entregar'])
            ->name('pedidos.entregar');
    });

    // TIENDA - PRODUCTOS Y PEDIDOS
    Route::middleware(['rol:tienda'])->prefix('tienda')->name('tienda.')->group(function () {

        // PRODUCTOS
        Route::get('/productos', [ProductoController::class, 'index'])
            ->name('productos.index');

        Route::get('/productos/crear', [ProductoController::class, 'create'])
            ->name('productos.create');

        Route::post('/productos', [ProductoController::class, 'store'])
            ->name('productos.store');

        Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])
            ->name('productos.edit');

        Route::put('/productos/{producto}', [ProductoController::class, 'update'])
            ->name('productos.update');

        Route::patch('/productos/{producto}/estado', [ProductoController::class, 'cambiarEstado'])
            ->name('productos.estado');

        // PEDIDOS
        Route::get('/pedidos', [PedidoTiendaController::class, 'index'])
            ->name('pedidos.index');

        Route::get('/pedidos/{pedido}', [PedidoTiendaController::class, 'show'])
            ->name('pedidos.show');

        Route::patch('/pedidos/detalle/{detalle}/listo', [PedidoTiendaController::class, 'marcarListo'])
            ->name('pedidos.listo');
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

// RUTAS CARRITO

Route::resource('carrito', CarritoController::class)
    ->only(['index', 'store', 'update', 'destroy']);
Route::get('/checkout', [PedidoController::class, 'create'])->name('checkout');
Route::post('/checkout', [PedidoController::class, 'store'])->name('pedido.store');




/* -- SOLO PRUEBA DE MAILTRAP --
Route::get('/test-correo-enviar', function () {
    $pedido = new App\Models\Pedido([
        'fecha' => now(), 'cliente' => 'María López', 'correo' => 'maria@mail.com',
        'telefono' => '8888-8888', 'total' => 75000, 'estado' => 'En preparación',
    ]);
    $pedido->id_pedido = 105;
    $pedido->setRelation('detalles', collect([
        new App\Models\Detalle(['nombre_producto' => 'Producto A', 'nombre_tienda' => 'Tienda Verde', 'cantidad' => 1, 'subtotal' => 25000]),
        new App\Models\Detalle(['nombre_producto' => 'Producto B', 'nombre_tienda' => 'Mundo Tech', 'cantidad' => 2, 'subtotal' => 50000]),
    ]));

    \Illuminate\Support\Facades\Mail::to($pedido->correo)->send(new App\Mail\PedidoConfirmado($pedido));

    return 'Correo enviado, revisa Mailtrap';
});
*/