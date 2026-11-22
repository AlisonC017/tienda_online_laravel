<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = 'detalles';
    protected $primaryKey = 'id_detalle';
    public $timestamps = false;
    protected $fillable = [
        'id_pedido',
        'id_producto',
        'id_tienda',
        'nombre_producto',
        'nombre_tienda',
        'precio',
        'cantidad',
        'subtotal',
        'estado'
    ];
}
