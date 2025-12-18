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
        Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('tagihan_id');
    $table->unsignedBigInteger('user_id');
    $table->string('bukti_bayar');
    $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
    $table->text('catatan')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
