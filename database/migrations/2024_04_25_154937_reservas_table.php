<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->dateTime('fecha_hora_reserva');
            $table->integer('numero_comensales');
            $table->string('estado_reserva');
            $table->timestamps();
        
            $table->foreign('id_user')->references('id')->on('users');
        });
        
    }

    
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
