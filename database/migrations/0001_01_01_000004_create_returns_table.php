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
        Schema::create('returns', function (Blueprint $table) {
    $table->id();
    $table->string('rma')->unique();
    $table->foreignId('client_id')->constrained();
    $table->string('request_line');
    $table->string('delivery_note');
    $table->date('send_date');
    $table->date('delivery_date')->nullable();
    $table->enum('status', ['OP', 'CO', 'CL'])->default('OP');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
