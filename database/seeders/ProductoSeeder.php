<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Productos;

class ProductoSeeder extends Seeder
{

    public function run(): void
    {
        Productos::create([
            'nombre_producto' => 'Papas',
            'descripcion' => 'Fritas',
            'precio' => 3.5,
            'categoria' => 'Tapas',
            'imagen' => 'lololo',
        ]);

    }
}
