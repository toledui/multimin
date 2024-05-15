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
        Schema::table('tickets', function (Blueprint $table) {
            // Eliminar las claves foráneas y columnas de vendor_id y distribuitor_id
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');
            $table->dropColumn('product_name');

            // Añadir la columna product_id y establecer la relación
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Restaurar vendor_id y distribuitor_id con claves foráneas
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->string('product_name')->nullable();

            // Eliminar la columna product_id
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
