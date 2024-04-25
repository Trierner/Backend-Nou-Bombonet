<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'fecha_hora_reserva', 'numero_comensales', 'estado_reserva',
    ];

    public function cliente()
    {
        return $this->belongsTo(Users::class, 'id_users');
    }
}
