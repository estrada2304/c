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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('rif')->unique(); // RIF único (ej: "J-123456789")
            $table->string('name'); // Nombre del cliente
            $table->string('region'); // Región (ej: "Centro", "Occidente")
            $table->string('email')->nullable(); // Opcional
            $table->string('phone')->nullable(); // Opcional
            $table->text('note')->nullable(); // Observaciones (opcional)
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
