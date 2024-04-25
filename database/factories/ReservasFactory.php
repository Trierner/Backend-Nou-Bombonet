<?php

namespace Database\Factories;

use App\Models\Users;
use App\Models\Reservas;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservasFactory extends Factory
{
    protected $model = Reservas::class;

    public function definition()
    {
        return [
            'id_user' => Users::inRandomOrder()->first()->id,
            'fecha_hora_reserva' => $this->faker->dateTimeThisYear(),
            'numero_comensales' => $this->faker->numberBetween(1, 10),
            'estado_reserva' => $this->faker->randomElement(['Pendiente', 'Confirmada', 'Cancelada']), 
        ];
    }
}
