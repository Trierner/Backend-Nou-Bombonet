<?php

namespace Database\Factories;

use App\Models\Users;
use App\Models\Pedidos;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidosFactory extends Factory
{
    protected $model = Pedidos::class;

    public function definition()
    {
        return [
            'id_user' => Users::inRandomOrder()->first()->id,
            'fecha_hora_pedido' => $this->faker->dateTimeThisYear(),
            'estado_pedido' => $this->faker->randomElement(['En proceso', 'Completado', 'Cancelado']), 
            'total' => $this->faker->randomFloat(2, 10, 100), 
            'para_llevar' => $this->faker->boolean(), 
        ];
    }
}
