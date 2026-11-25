<?php

namespace App\Support;

class Imagen
{
    /**
     * URL de un archivo guardado en public/uploads.
     * Si no hay nombre o el archivo no existe, devuelve una imagen de relleno.
     */
    public static function url(?string $nombre, string $relleno = '600x600'): string
    {
        if ($nombre && is_file(public_path('uploads/' . basename($nombre)))) {
            return asset('uploads/' . basename($nombre));
        }

        return 'https://placehold.co/' . $relleno . '/e9e2d8/5a3707?text=CrikoStore';
    }
}