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
        Schema::create('exports', function (Blueprint $table) {
    $table->id();
    $table->string('part_code');
    $table->string('serial');
    $table->string('category');
    $table->string('tracking_number');
    $table->date('collection_date');
    $table->date('delivery_date_malaysia');
    $table->string('rma');
    $table->enum('status', ['PREPARING', 'IN_TRANSIT', 'DELIVERED'])->default('PREPARING');
    $table->text('notes')->nullable();
    $table->timestamps();
    
    // Relación con inventario
    $table->foreign('serial')->references('serial')->on('inventory')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};
