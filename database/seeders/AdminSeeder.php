<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    
    public function run(): void
    {
        Users::create([
            'nombre' => 'Dario',
            'apellido' => 'Carmona',
            'correo' => 'dario@gmail.com',
            'contraseña' => Hash::make('password'), // Recuerda utilizar Hash::make() para almacenar la contraseña de forma segura
            'telefono' => '626478375',
            'admin' => true,
        ]);
    }
}
