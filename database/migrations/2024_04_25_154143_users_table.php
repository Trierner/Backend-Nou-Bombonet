<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->unique();
            $table->string('contraseña');
            $table->string('telefono', 8)->nullable();
            $table->string('direccion')->nullable();
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

    }

    
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
