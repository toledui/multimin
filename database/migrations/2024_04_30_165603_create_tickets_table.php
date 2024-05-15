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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number');
            $table->unsignedBigInteger('distribuitor_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('user_id');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('total_amount', 8, 2);
            $table->timestamps();

             // Claves foráneas
             $table->foreign('distribuitor_id')->references('id')->on('distribuitors');
             $table->foreign('vendor_id')->references('id')->on('vendors');
             $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
