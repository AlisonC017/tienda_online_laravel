<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    public $timestamps = false;
    protected $fillable = ['fecha', 'cliente', 'correo', 'telefono', 'total', 'estado'];
    protected $casts = ['fecha' => 'datetime'];

    public function detalles()
    {
        return $this->hasMany(Detalle::class, 'id_pedido', 'id_pedido');
    }

    public function actualizarEstado(): void
    {
        if ($this->estado === 'Entregado') {
            return;
        }

        $hayPendientes = $this->detalles()->where(fn($q) => $q->whereNull('estado')->orWhere('estado', '!=', 'Listo'))->exists();

        $this->estado = $hayPendientes ? 'En preparación' : 'Listo';
        $this->save();
    }
}
