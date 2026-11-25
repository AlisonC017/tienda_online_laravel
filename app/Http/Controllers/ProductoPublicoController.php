<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoPublicoController extends Controller
{
    // Productos activos de tiendas activas
    private function visibles()
    {
        return Producto::where('activo', 1)
            ->whereHas('tienda', fn ($q) => $q->where('activa', 1));
    }

    public function index(Request $request)
    {
        $request->validate([
            'categoria' => 'nullable|integer',
            'q'         => 'nullable|string|max:100',
        ]);

        $categoriaId = $request->integer('categoria') ?: null;
        $busqueda    = trim((string) $request->input('q', ''));

        $productos = $this->visibles()
            ->with('tienda')
            ->when($categoriaId, fn ($q) => $q->whereHas('categorias', fn ($c) => $c->where('categorias.id_categoria', $categoriaId)))
            ->when($busqueda !== '', fn ($q) => $q->where('nombre', 'like', '%' . $busqueda . '%'))
            ->orderByDesc('id_producto')
            ->paginate(12)
            ->withQueryString();

        // Panel lateral: cantidad de productos visibles por categoría
        $categorias = Categoria::orderBy('nombre')
            ->withCount(['productos as total' => function ($q) {
                $q->where('productos.activo', 1)
                  ->whereHas('tienda', fn ($t) => $t->where('activa', 1));
            }])
            ->get();

        $totalGeneral = $this->visibles()->count();
        $categoriaActual = $categorias->firstWhere('id_categoria', $categoriaId);

        return view('modules.landing.productos.index', compact(
            'productos', 'categorias', 'totalGeneral', 'categoriaId', 'categoriaActual', 'busqueda'
        ));
    }

    public function show($id)
    {
        $producto = $this->visibles()
            ->with(['tienda', 'categorias', 'imagenes'])
            ->where('id_producto', $id)
            ->firstOrFail();

        return view('modules.landing.productos.show', compact('producto'));
    }
}