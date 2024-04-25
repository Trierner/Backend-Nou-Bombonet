<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesPedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pedido', 'id_producto', 'cantidad', 'precio_unitario', 'especificaciones',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'id_pedido');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}
