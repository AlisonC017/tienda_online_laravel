<?php

namespace App\Models;

use App\Support\Imagen;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = 'tiendas';

    protected $primaryKey = 'id_tienda';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario', 'nombre', 'descripcion', 'logo', 'banner',
        'whatsapp', 'telefono', 'correo', 'instagram', 'facebook', 'youtube',
        'destacada', 'activa',
    ];

    protected $casts = [
        'destacada' => 'boolean',
        'activa' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_tienda', 'id_tienda');
    }

    public function productosActivos()
    {
        return $this->productos()->where('activo', 1);
    }

    // Solo tiendas visibles en el sitio publico
    public function scopeActivas($query)
    {
        return $query->where('activa', 1);
    }

    public function logoUrl(string $relleno = '200x200'): string
    {
        return Imagen::url($this->logo, $relleno);
    }

    public function bannerUrl(string $relleno = '1200x300'): string
    {
        return Imagen::url($this->banner, $relleno);
    }

    // Correo al que llegan los mensajes del formulario de contacto
    public function correoContacto(): ?string
    {
        return $this->correo ?: optional($this->usuario)->correo;
    }

    public function whatsappUrl(): ?string
    {
        $numero = preg_replace('/\D/', '', (string) $this->whatsapp);
        if ($numero === '') {
            return null;
        }
        if (strlen($numero) === 8) {
            $numero = '506'.$numero;
        }

        return 'https://wa.me/'.$numero;
    }

    public function telefonoUrl(): ?string
    {
        $numero = preg_replace('/[^\d+]/', '', (string) $this->telefono);

        return $numero === '' ? null : 'tel:'.$numero;
    }

    public function instagramUrl(): ?string
    {
        return $this->redSocial($this->instagram, 'https://www.instagram.com/');
    }

    public function facebookUrl(): ?string
    {
        return $this->redSocial($this->facebook, 'https://www.facebook.com/');
    }

    public function youtubeUrl(): ?string
    {
        return $this->redSocial($this->youtube, 'https://www.youtube.com/');
    }

    // Acepta una URL completa o solo el usuario (@usuario)
    private function redSocial(?string $valor, string $base): ?string
    {
        $valor = trim((string) $valor);
        if ($valor === '') {
            return null;
        }
        if (preg_match('#^https?://#i', $valor)) {
            return $valor;
        }

        return $base.ltrim($valor, '@/');
    }

    public function detalles()
    {
        return $this->hasMany(Detalle::class, 'id_tienda', 'id_tienda');
    }

    public function scopeTopVentas($query, int $limite = 3)
    {
        return $query->activas()
            ->withSum(['detalles as monto_vendido' => fn ($d) => $d->whereHas('pedido', fn ($p) => $p->where('estado', 'Entregado')),
            ], 'subtotal')
            ->having('monto_vendido', '>', 0)
            ->orderByDesc('monto_vendido')
            ->limit($limite);
    }
}
