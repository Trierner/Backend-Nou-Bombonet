<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
protected $model = Users::class;

protected static $contraseña; 

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->word(),
            'correo' => $this->faker->unique()->safeEmail(),
            'contraseña' => static::$contraseña ??= Hash::make('password'),
            'telefono' => $this->faker->randomNumber(9, true),
            'admin' => false,
            'remember_token' => Str::random(10),
        ];
    }
}
