<?php

namespace App\Providers;


use App\Http\Controllers\CarritoController;
use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Tienda;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        // Notificaciones de pedidos pendientes para Admin y Tienda
        View::composer(['layouts.admin.header', 'layouts.tienda.header'], function ($view) {
            $notificaciones = collect();

            if (Auth::check()) {
                $usuario = Auth::user();

                if ($usuario->rol === 'administrador') {
                    $notificaciones = Pedido::whereIn('estado', ['Pendiente', 'En preparación'])
                        ->orderByDesc('fecha')
                        ->take(5)
                        ->get()
                        ->map(fn($p) => [
                            'titulo' => "Pedido #{$p->id_pedido} de {$p->cliente}",
                            'tiempo' => Carbon::parse($p->fecha)->diffForHumans(),
                            'url'    => route('admin.pedidos.show', $p->id_pedido),
                            'icono'  => 'fa-shopping-bag',
                        ]);
                } else {
                    $tienda = Tienda::where('id_usuario', $usuario->id_usuario)->first();

                    if ($tienda) {
                        $notificaciones = DB::table('detalles')
                            ->join('pedidos', 'detalles.id_pedido', '=', 'pedidos.id_pedido')
                            ->where('detalles.id_tienda', $tienda->id_tienda)
                            ->where('detalles.estado', 'Pendiente')
                            ->select('detalles.*', 'pedidos.fecha')
                            ->orderByDesc('detalles.id_detalle')
                            ->take(5)
                            ->get()
                            ->map(fn($d) => [
                                'titulo' => "{$d->cantidad}x {$d->nombre_producto}",
                                'tiempo' => $d->fecha ? Carbon::parse($d->fecha)->diffForHumans() : 'Reciente',
                                'url'    => route('tienda.pedidos.show', $d->id_pedido),
                                'icono'  => 'fa-box-open',
                            ]);
                    }
                }
            }

            $view->with('notificacionesPanel', $notificaciones);
        });
    }
}
