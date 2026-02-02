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
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 25);
            $table->string('tipo', 40);
            $table->decimal('peso', 5, 2)->nullable();
            $table->string('enfermedad', 100)->nullable();
            $table->longText('comentarios')->nullable();
            $table->foreign('dueno_id')->references('id')->on('duenos')->onDelete('cascade'); // Si se elimina un dueño, se borran sus animales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
