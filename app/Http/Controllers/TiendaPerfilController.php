<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TiendaPerfilController extends Controller
{
    public function edit()
    {
        $tienda = $this->tiendaActual();

        return view('modules.tienda.mi-tienda', compact('tienda'));
    }

    public function update(Request $request)
    {
        $tienda = $this->tiendaActual();

        // Los números se guardan solo con dígitos (whatsapp hasta 11, teléfono 8)
        $request->merge([
            'whatsapp' => $this->soloDigitos($request->input('whatsapp')),
            'telefono' => $this->soloDigitos($request->input('telefono')),
        ]);

        $datos = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'whatsapp'    => 'nullable|digits_between:8,11',
            'telefono'    => 'nullable|digits:8',
            'correo'      => 'nullable|email|max:100',
            'instagram'   => 'nullable|string|max:255',
            'facebook'    => 'nullable|string|max:255',
            'youtube'     => 'nullable|string|max:255',
        ], [
            'nombre.required' => 'El nombre de la tienda es obligatorio.',
            'logo.image'      => 'El logo debe ser una imagen.',
            'logo.mimes'      => 'El logo debe ser JPG, PNG o WEBP.',
            'logo.max'        => 'El logo no puede pesar más de 2 MB.',
            'banner.image'    => 'El banner debe ser una imagen.',
            'banner.mimes'    => 'El banner debe ser JPG, PNG o WEBP.',
            'banner.max'      => 'El banner no puede pesar más de 4 MB.',
            'descripcion.max' => 'La descripción no puede pasar de 255 caracteres.',
            'whatsapp.digits_between' => 'El WhatsApp debe tener entre 8 y 11 números.',
            'telefono.digits' => 'El teléfono debe tener 8 números.',
            'correo.email'    => 'El correo no es válido.',
            'correo.max'      => 'El correo no puede pasar de 100 caracteres.',
        ]);

        // Solo estos campos; activa y destacada las controla el administrador
        $tienda->nombre      = $datos['nombre'];
        $tienda->descripcion = $datos['descripcion'] ?? ''; // la columna no admite NULL
        $tienda->whatsapp    = $datos['whatsapp'] ?? null;
        $tienda->telefono    = $datos['telefono'] ?? null;
        $tienda->correo      = $datos['correo'] ?? null;
        $tienda->instagram   = $datos['instagram'] ?? null;
        $tienda->facebook    = $datos['facebook'] ?? null;
        $tienda->youtube     = $datos['youtube'] ?? null;

        if ($request->hasFile('logo')) {
            $this->borrarArchivo($tienda->logo);
            $tienda->logo = $this->guardarArchivo($request->file('logo'));
        }
        if ($request->hasFile('banner')) {
            $this->borrarArchivo($tienda->banner);
            $tienda->banner = $this->guardarArchivo($request->file('banner'));
        }

        $tienda->save();

        return redirect()->route('tienda.mi-tienda')->with('ok', 'Los datos de tu tienda se guardaron correctamente.');
    }

    // Tienda del usuario logueado (se crea vacía si todavía no existe)
    private function tiendaActual(): Tienda
    {
        $usuario = Auth::user();

        return Tienda::firstOrCreate(
            ['id_usuario' => $usuario->id_usuario],
            ['nombre' => $usuario->nombre, 'descripcion' => '', 'destacada' => 0, 'activa' => 1]
        );
    }

    private function soloDigitos($valor): ?string
    {
        $digitos = preg_replace('/\D/', '', (string) $valor);

        return $digitos === '' ? null : $digitos;
    }

    private function guardarArchivo($archivo): string
    {
        $nombre = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->move(public_path('uploads'), $nombre);

        return $nombre;
    }

    private function borrarArchivo(?string $nombre): void
    {
        if ($nombre && is_file(public_path('uploads/' . basename($nombre)))) {
            unlink(public_path('uploads/' . basename($nombre)));
        }
    }
}