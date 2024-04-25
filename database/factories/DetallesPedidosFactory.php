<?php

namespace Database\Factories;

use App\Models\Pedidos;
use App\Models\Productos;
use App\Models\DetallesPedidos;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetallesPedidosFactory extends Factory
{
    protected $model = DetallesPedidos::class;

    public function definition()
    {
        return [
            'id_pedido' => Pedidos::inRandomOrder()->first()->id,
            'id_producto' => Productos::inRandomOrder()->first()->id,
            'cantidad' => $this->faker->numberBetween(1, 5),
            'precio_unitario' => $this->faker->randomFloat(2, 5, 50),
            'especificaciones' => $this->faker->sentence(),
        ];
    }
}
