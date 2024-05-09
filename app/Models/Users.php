<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'nombre', 'apellido', 'correo', 'telefono', 'admin',
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
