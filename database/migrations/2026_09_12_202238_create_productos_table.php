<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * crear la tabla de productos
     */
    public function up(): void
    {
       Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('nombre');
            $table->string('descripcion_corta');
            $table->text('descripcion_larga');
            $table->string('imagen')->nullable();
            $table->decimal('precio_neto', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->integer('stock_actual');
            $table->integer('stock_minimo');
            $table->integer('stock_bajo');
            $table->integer('stock_alto');
            $table->timestamps();
        });
    }

    /**
     * revertir la migración y eliminar la tabla de productos
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
