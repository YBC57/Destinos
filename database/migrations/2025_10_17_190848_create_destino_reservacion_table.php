<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destino_reservacion', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('destino_id');
            $table->foreign('destino_id')->references('id')->on('destinos')->onDelete('cascade');
            $table->unsignedBigInteger('reservacion_id');
            $table->foreign('reservacion_id')->references('id')->on('reservaciones')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destino_reservacion');
    }
};
