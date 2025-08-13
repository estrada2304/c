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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // ID automático (bigIncrements)
            $table->string('name')->unique(); // Nombre único (ej: "admin")
            $table->string('description'); // Descripción del rol
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
