<?php

namespace App\Http\Controllers;

use App\Models\Producto;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->items();
        $total = $data->sum('subtotal');
        return view('modules.landing.carrito.index', compact('data', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'id_producto' => 'required|integer',
                'cantidad' => 'required|integer|min:1|max:99',
            ]
        );

        $producto = Producto::with('tienda')
            ->where('id_producto', $data['id_producto'])
            ->where('activo', 1)->first();

        if (!$producto || !$producto->tienda->activa) {
            return back()->with('error', 'Producto no disponible :b');
        }

        $carrito = session('carrito', []);
        $id = $producto->id_producto;
        $carrito[$id] = min(99, ($carrito[$id] ?? 0 + $data['cantidad']));
        session(['carrito' => $carrito]);

        return back()->with('ok', 'Producto agregado al carrito :D');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'cantidad' => 'required|integer|min:1|max:99',
        ]);

        $carrito = session('carrito', []);
        if (isset($carrito[$id])) {
            $carrito[$id] = $data['cantidad'];
            session(['carrito' => $carrito]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carrito = session('carrito', []);
        unset($carrito[$id]);
        session(['carrito' => $carrito]);
        return back()->with('ok', 'Producto eliminado :D');
    }


    public static function items()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return collect();
        }
        
        $productos = Producto::with('tienda')
            ->whereIn('id_producto', array_keys($carrito))
            ->where('activo', 1)
            ->get();

        return $productos->map(function ($p) use ($carrito) {
            $cantidad = $carrito[$p->id_producto];
            return (object) [
                'producto' => $p,
                'cantidad' => $cantidad,
                'subtotal' => $p->precio * $cantidad,
            ];
        });
    }
}
