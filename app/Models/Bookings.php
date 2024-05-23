<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'booking_date', 'num_diners', 'booking_state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
