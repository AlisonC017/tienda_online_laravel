<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    private const MAX_GALERIA = 4;

    public function index()
    {
        $tienda = $this->tiendaActual();
        $productos = Producto::where('id_tienda', $tienda->id_tienda)->with('categorias')->orderByDesc('id_producto')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $tienda = $this->tiendaActual();
        $datos = $request->validate($this->reglas(true));

        $producto = Producto::create([
            'id_tienda'   => $tienda->id_tienda,
            'nombre'      => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'precio'      => $datos['precio'],
            'imagen'      => $this->guardarArchivo($request->file('imagen')),
            'activo'      => true,
        ]);

        $producto->categorias()->sync($datos['categorias']);

        foreach ($request->file('galeria', []) as $archivo) {
            $producto->imagenes()->create([
                'imagen' => $this->guardarArchivo($archivo),
            ]);
        }
        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $this->verificarDueno($producto);
        $categorias = Categoria::orderBy('nombre')->get();
        $producto->load('categorias', 'imagenes');
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $this->verificarDueno($producto);
        $datos = $request->validate($this->reglas(false));
        $aEliminar = $producto->imagenes()->whereIn('id_imagen', $request->input('eliminar_imagenes', []))->get();
        $nuevas = $request->file('galeria', []);

        $restantes = $producto->imagenes()->count() - $aEliminar->count();
        if ($restantes + count($nuevas) > self::MAX_GALERIA) {
            return back()->withInput()->withErrors([
                'galeria' => 'La galería permite máximo ' . self::MAX_GALERIA . ' imágenes adicionales.',
            ]);
        }

        $producto->nombre      = $datos['nombre'];
        $producto->descripcion = $datos['descripcion'];
        $producto->precio      = $datos['precio'];

        if ($request->hasFile('imagen')) {
            $this->borrarArchivo($producto->imagen);
            $producto->imagen = $this->guardarArchivo($request->file('imagen'));
        }

        $producto->save();
        $producto->categorias()->sync($datos['categorias']);

        foreach ($aEliminar as $img) {
            $this->borrarArchivo($img->imagen);
            $img->delete();
        }

        foreach ($nuevas as $archivo) {
            $producto->imagenes()->create([
                'imagen' => $this->guardarArchivo($archivo),
            ]);
        }
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function cambiarEstado(Producto $producto)
    {
        $this->verificarDueno($producto);
        $producto->activo = !$producto->activo;
        $producto->save();
        return back()->with('success', $producto->activo ? 'Producto activado.' : 'Producto desactivado.');
    }

    // Tienda del usuario logueado
    private function tiendaActual(): Tienda
    {
        return Tienda::where('id_usuario', Auth::id())->firstOrFail();
    }

    private function verificarDueno(Producto $producto): void
    {
        abort_if((int) $producto->id_tienda !== (int) $this->tiendaActual()->id_tienda, 403);
    }

    private function guardarArchivo($archivo): string
    {
        $nombre = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->move(public_path('uploads'), $nombre);

        return $nombre;
    }

    private function borrarArchivo(?string $nombre): void
    {
        if ($nombre && file_exists(public_path('uploads/' . $nombre))) {
            unlink(public_path('uploads/' . $nombre));
        }
    }

    private function reglas(bool $esCreacion): array
    {
        return [
            'nombre'              => 'required|string|max:150',
            'descripcion'         => 'required|string|max:255',
            'precio'              => 'required|numeric|min:0',
            'imagen'              => ($esCreacion ? 'required' : 'nullable') . '|image|max:2048',
            'galeria'             => 'nullable|array',
            'galeria.*'           => 'image|max:2048',
            'eliminar_imagenes'   => 'nullable|array',
            'eliminar_imagenes.*' => 'integer',
            'categorias'          => 'required|array|min:1',
            'categorias.*'        => 'exists:categorias,id_categoria',
        ];
    }
}
