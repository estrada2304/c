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
        Schema::create('imports', function (Blueprint $table) {
    $table->id();
    $table->string('part_code');
    $table->string('serial');
    $table->string('category');
    $table->string('tracking_number');
    $table->date('pre_alert_date');
    $table->date('eta');
    $table->date('receipt_date_venezuela')->nullable();
    $table->enum('status', ['PRE_ALERTED', 'IN_TRANSIT', 'ARRIVED', 'STORED'])->default('PRE_ALERTED');
    $table->text('notes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};
