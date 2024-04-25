<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido', 'correo', 'contraseña', 'telefono', 'admin',
    ];

    protected $hidden = [
        'contraseña', 'remember_token',
    ];

    // Relación con pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedidos::class);
    }

    // Relación con reservas
    public function reservas()
    {
        return $this->hasMany(Reservas::class, 'id_user');
    }
}
