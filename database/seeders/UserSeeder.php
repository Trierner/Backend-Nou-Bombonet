<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {

        // $correo = 'user' . rand(100, 999) . '@example.com';
        
        // Users::create([
        //     'nombre' => 'User',
        //     'apellido' => 'User',
        //     'correo' => $correo,
        //     'contraseña' => Hash::make('password'), // Recuerda utilizar Hash::make() para almacenar la contraseña de forma segura
        //     'telefono' => '123456798',
        //     'admin' => false,
        // ]);

        Users::factory()->count(10)->create();
    }
}
