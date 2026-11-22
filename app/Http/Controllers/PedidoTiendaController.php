<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Detalle;
use App\Models\Tienda;
use Illuminate\Support\Facades\Auth;

class PedidoTiendaController extends Controller
{
    private function tiendaActual()
    {
        return Tienda::where('id_usuario', Auth::id())->firstOrFail();
    }

    public function index()
    {
        $tienda = $this->tiendaActual();

        $pedidos = Pedido::whereHas('detalles', function ($query) use ($tienda) {
            $query->where('id_tienda', $tienda->id_tienda);
        })->with(['detalles' => function ($query) use ($tienda) {
            $query->where('id_tienda', $tienda->id_tienda);
        }])->orderByDesc('fecha')->get();

        return view('pedidos-tienda.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        $tienda = $this->tiendaActual();

        $detalles = $pedido->detalles()->where('id_tienda', $tienda->id_tienda)->get();

        // Verificar que el pedido tenga productos de esta tienda
        abort_if($detalles->isEmpty(), 403);

        return view('pedidos-tienda.show', compact('pedido', 'detalles'));
    }

    public function marcarListo(Detalle $detalle)
    {
        $tienda = $this->tiendaActual();

        // Verificar que el detalle pertenezca a la tienda
        abort_if((int) $detalle->id_tienda !== (int) $tienda->id_tienda, 403);
        $pedido = $detalle->pedido;

        if ($pedido->estado === 'Entregado') {
            return back()->with('error', 'El pedido ya fue entregado.');
        }

        $detalle->estado = 'Listo';
        $detalle->save();
        $pedido->actualizarEstado();
        return back()->with('success', 'Producto marcado como listo.');
    }
}
