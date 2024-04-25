<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pedidos;
use App\Models\DetallesPedidos;
use App\Models\Reservas;

class PedidoReservaSeeder extends Seeder
{
    
    public function run(): void
    {
        // Crear algunos pedidos
        Pedidos::factory()->count(15)->create();

        // Crear algunos detalles de pedidos
        DetallesPedidos::factory()->count(25)->create();

        // Crear algunas reservas
        Reservas::factory()->count(10)->create();
    }
}
