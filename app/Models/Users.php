<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject 
{
    use HasFactory;
    use Notifiable;

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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
