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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('part_code'); // Código de parte
            $table->string('serial')->unique(); // Serial único
            $table->string('bin'); // Ubicación en almacén
            $table->enum('category', ['BUFR', 'FAULTY', 'MIA', 'SCRAP', 'EXS']); // Categorías permitidas
            $table->decimal('price', 10, 2); // Precio con 10 dígitos y 2 decimales
            $table->text('description')->nullable(); // Descripción opcional
            $table->enum('status', ['CO', 'OP', 'CL'])->default('OP'); // Estado con valor por defecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
