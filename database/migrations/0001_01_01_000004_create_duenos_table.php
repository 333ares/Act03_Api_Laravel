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
            // Si se borra un animal, se borra su dueño
            $table->foreignId('id_animal')->constrained('animales')->onDelete('cascade');
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
