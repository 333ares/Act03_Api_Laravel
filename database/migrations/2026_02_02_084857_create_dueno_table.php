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
        Schema::create('dueno', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('id_animal')->constrained();
            $table->string('nombre', 25);
            $table->string('apellido', 35);
            $table->timestamps()->nullable();
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
