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
        Schema::table('destinos', function (Blueprint $table) {
            // Agregar campo categoria_id después del id
            $table->unsignedBigInteger('categoria_id')->nullable()->after('id');

            // Crear relación con la tabla categorias
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            // Primero eliminar la llave foránea
            $table->dropForeign(['categoria_id']);

            // Luego eliminar la columna
            $table->dropColumn('categoria_id');
        });
    }
};

