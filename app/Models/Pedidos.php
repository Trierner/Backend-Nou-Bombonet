<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'fecha_hora_pedido', 'estado_pedido', 'total', 'para_llevar',
    ];

    public function cliente()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function detalles()
    {
        return $this->hasMany(DetallesPedidos::class, 'id_pedido');
    }
}
