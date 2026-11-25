<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class PedidoAdminController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('detalles')->orderByDesc('fecha')->get();
        return view('modules.admin.pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('detalles');
        return view('modules.admin.pedidos.show', compact('pedido'));
    }

    public function entregar(Pedido $pedido)
    {
        if ($pedido->estado === 'Entregado') {
            return back()->with('error', 'Este pedido ya fue entregado.');
        }

        if ($pedido->estado !== 'Listo') {
            return back()->with('error', 'No se puede entregar un pedido que aun tiene productos pendientes.');
        }

        $pedido->estado = 'Entregado';
        $pedido->save();
        return redirect()->route('admin.pedidos.show', $pedido)->with('success', 'Pedido marcado como entregado correctamente.');
    }
}
