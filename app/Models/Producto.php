<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
