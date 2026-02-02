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
        Schema::create('duenos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 25);
            $table->string('apellido', 35);
            $table->unsignedBigInteger('id_animal'); // Primero creo la columna
            // Después la FK
            $table->foreign('id_animal')
                ->references('id')
                ->on('animales')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
