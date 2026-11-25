<?php

namespace App\Http\Controllers;

use App\Models\Tienda;

class AdminTiendaController extends Controller
{
    public function index()
    {
        $tiendas = Tienda::orderBy('nombre')->get();
        return view('modules.admin.tienda.index', compact('tiendas'));
    }

    public function toggleActiva(Tienda $tienda)
    {
        $tienda->activa = !$tienda->activa;

        // Una tienda inactiva no puede estar en el slider
        if (!$tienda->activa) {
            $tienda->destacada = false;
        }
        $tienda->save();

        return back()->with('success', $tienda->activa
            ? "La tienda {$tienda->nombre} fue activada."
            : "La tienda {$tienda->nombre} fue desactivada. Ya no se ve en el sitio público.");
    }

    public function toggleDestacada(Tienda $tienda)
    {
        if (!$tienda->activa) {
            return back()->with('error', 'Solo se pueden destacar tiendas activas.');
        }

        $tienda->destacada = !$tienda->destacada;
        $tienda->save();

        return back()->with('success', $tienda->destacada
            ? "{$tienda->nombre} ahora sale en el slider."
            : "{$tienda->nombre} se quitó del slider.");
    }
}
