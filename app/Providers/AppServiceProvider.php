<?php

namespace App\Providers;

use App\Http\Controllers\CarritoController;
use App\Models\Categoria;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.landing.*', function ($view) {
            $carritoData = CarritoController::items();

            $view->with([
                'carritoData'     => $carritoData,
                'carritoTotal'    => $carritoData->sum('subtotal'),
                'carritoCantidad' => $carritoData->sum('cantidad'),
                'categoriasGlobal' => Categoria::orderBy('nombre')->get(),
            ]);
        });
    }
}
