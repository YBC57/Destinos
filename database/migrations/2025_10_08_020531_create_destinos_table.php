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
        Schema::create('destinos', function (Blueprint $table) {
           $table->id();
$table->unsignedBigInteger('user_id'); // Relación con usuarios
$table->string('nombre');
$table->string('descripcion');
$table->string('precio');  // tipo corregido a string
$table->string('fecha_inicio'); // tipo corregido a string
$table->string('imagen')->nullable; // Corregido
$table->timestamps();
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    
    {
        Schema::dropIfExists('destinos');
    }
};