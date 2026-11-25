<?php

namespace App\Http\Controllers;

use App\Mail\PedidoConfirmado;
use App\Models\Detalle;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = CarritoController::items();

        if ($data->isEmpty()) {
            return redirect()->route('carrito.index')->with('Error', 'Tu carrito esta vacio');
        }

        $total = $data->sum('subtotal');
        return view('modules.landing.checkout.index', compact('data', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'cliente' => 'required|string|max:100',
            'correo' => 'required|email|max:100',
            'telefono' => 'nullable|string|max:20',
        ]);

        $data = CarritoController::items();

        if ($data->isEmpty()) {
            redirect()->route('carrito.index')->with('Error', 'Tu carrito ta vacio');
        }

        $pedido = DB::transaction(function () use ($input, $data) {
            $pedido = Pedido::create([
                'fecha' => now(),
                'cliente' => $input['cliente'],
                'correo' => $input['correo'],
                'telefono' => $input['telefono'] ?? '',
                'total' => $data->sum('subtotal'),
                'estado' => 'En preparacion',
            ]);

            foreach ($data as $item) {
                Detalle::create([
                    'id_pedido'       => $pedido->id_pedido,
                    'id_producto'     => $item->producto->id_producto,
                    'id_tienda'       => $item->producto->id_tienda,
                    'nombre_producto' => $item->producto->nombre,
                    'nombre_tienda'   => $item->producto->tienda->nombre,
                    'precio'          => $item->producto->precio,
                    'cantidad'        => $item->cantidad,
                    'subtotal'        => $item->subtotal,
                    'estado'          => 'En espera',
                ]);
            }

            return $pedido;
        });

        session()->forget('carrito');

        // Configuracion MAIL
        try {
            Mail::to($pedido->correo)->send(new PedidoConfirmado($pedido->load('detalles')));
        } catch (\Exception $e) {
            Log::error('No se puedo enviar el correo del pedido: ' . $e->getMessage());
        }


        return redirect('/')->with('ok', 'Pedido #' . $pedido->id_pedido . ' realizado con exito! Te enviamos el desglose a tu correo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
