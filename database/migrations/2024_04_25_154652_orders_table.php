<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->timestamp('date')->useCurrent();
            $table->string('state');
            $table->decimal('total', 10, 2);
            $table->boolean('carry');
            $table->timestamps();
        
            $table->foreign('id_user')->references('id')->on('users');
        });
        
    }

    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
