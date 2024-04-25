<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->timestamp('fecha_hora_pedido')->useCurrent();
            $table->string('estado_pedido');
            $table->decimal('total', 10, 2);
            $table->boolean('para_llevar');
            $table->timestamps();
        
            $table->foreign('id_users')->references('id')->on('users');
        });
        
    }

    
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
