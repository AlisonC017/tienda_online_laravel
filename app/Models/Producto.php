<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Imagen as ImagenHelper;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    protected $fillable = ['id_tienda', 'nombre', 'descripcion', 'precio', 'imagen', 'activo'];
    protected $casts = ['activo' => 'boolean'];

    public function tienda()
    {
        return $this->belongsTo(Tienda::class, 'id_tienda', 'id_tienda');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'producto_categoria', 'id_producto', 'id_categoria');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'id_producto', 'id_producto');
    }

    public function detalles()
    {
        return $this->hasMany(Detalle::class, 'id_producto', 'id_producto');
    }

    // Productos activos de tiendas activas
    public function scopeVisibles($query)
    {
        return $query->where('activo', 1)
        ->whereHas('tienda', fn ($t) => $t->where('activa', 1));
    }
        
    // Los más vendidos según la suma de cantidades en detalles
    public function scopeTopVentas($query, int $limite = 5)
    {
    return $query->visibles()
        ->with('tienda')
        ->withSum(['detalles as total_vendido' => fn ($d) =>
            $d->whereHas('pedido', fn ($p) => $p->where('estado', 'Entregado'))
        ], 'cantidad')
        ->having('total_vendido', '>', 0)
        ->orderByDesc('total_vendido')
        ->limit($limite);
        }

    public function imagenUrl(string $relleno = '600x600'): string
    {
        return ImagenHelper::url($this->imagen, $relleno);
    }
}
