<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_order', 'id_product', 'amount', 'unit_price', 'specs',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'id_order');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'id_product');
    }
}
