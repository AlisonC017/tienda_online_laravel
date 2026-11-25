<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tienda;
use App\Models\Producto;
use App\Models\Pedido;

class ControllerNavigation extends Controller
{

    public function landing()
    {
        $destacadas = Tienda::activas()->where('destacada', true)->get();
    $topVentas  = Producto::topVentas(5)->get();
    $tiendas    = Tienda::topVentas(3)->get();
    $entregados = Pedido::where('estado', 'Entregado');

    $stats = [
        'tiendas'   => Tienda::activas()->count(),
        'ventas'    => (clone $entregados)->count(),
        'ganancias' => (clone $entregados)->sum('total'),
    ];

    return view('modules.landing.index', compact('destacadas', 'topVentas', 'tiendas', 'stats'));
    }
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('login', ['tab' => 'signup']);
    }

    public function dashboard()
    {
        return Auth::user()->esAdmin()
            ? redirect()->route('admin.index')
            : redirect()->route('tienda.index');
    }

    public function adminDashboard()
    {
        return view('modules.admin.index');
    }

    public function tiendaDashboard()
    {
        return view('modules.tienda.index');
    }
}
