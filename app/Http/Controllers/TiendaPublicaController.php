<?php

namespace App\Http\Controllers;

use App\Mail\ContactoTienda;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TiendaPublicaController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['q' => 'nullable|string|max:100']);
        $busqueda = trim((string) $request->input('q', ''));

        $tiendas = Tienda::activas()
            ->when($busqueda !== '', fn ($q) => $q->where('nombre', 'like', '%' . $busqueda . '%'))
            ->orderBy('nombre')
            ->paginate(9)
            ->withQueryString();

        return view('modules.landing.tiendas.index', compact('tiendas', 'busqueda'));
    }

    public function show($id)
    {
        $tienda = Tienda::activas()->where('id_tienda', $id)->firstOrFail();
        $productos = $tienda->productosActivos()->orderByDesc('id_producto')->get();

        return view('modules.landing.tiendas.show', compact('tienda', 'productos'));
    }

    public function contacto(Request $request, $id)
    {
        $tienda = Tienda::activas()->where('id_tienda', $id)->firstOrFail();

        $datos = $request->validate([
            'nombre'  => 'required|string|max:100',
            'correo'  => 'required|email|max:150',
            'mensaje' => 'required|string|min:10|max:1000',
        ], [
            'nombre.required'  => 'Escribe tu nombre.',
            'correo.required'  => 'Escribe tu correo.',
            'correo.email'     => 'El correo no es válido.',
            'mensaje.required' => 'Escribe tu mensaje.',
            'mensaje.min'      => 'El mensaje debe tener al menos 10 caracteres.',
            'mensaje.max'      => 'El mensaje no puede pasar de 1000 caracteres.',
        ]);

        $destino = $tienda->correoContacto();
        if (!$destino) {
            return redirect()->to(route('tiendas.show', $tienda->id_tienda) . '#contacto')
                ->withInput()
                ->with('error', 'Esta tienda no tiene un correo de contacto configurado.');
        }

        try {
            Mail::to($destino)->send(new ContactoTienda(
                $tienda, $datos['nombre'], $datos['correo'], $datos['mensaje']
            ));
        } catch (\Throwable $e) {
            Log::error('Error enviando contacto a tienda ' . $tienda->id_tienda . ': ' . $e->getMessage());

            return redirect()->to(route('tiendas.show', $tienda->id_tienda) . '#contacto')
                ->withInput()
                ->with('error', 'No se pudo enviar el mensaje. Inténtalo de nuevo más tarde.');
        }

        return redirect()->to(route('tiendas.show', $tienda->id_tienda) . '#contacto')
            ->with('ok', 'Tu mensaje fue enviado a la tienda.');
    }
}