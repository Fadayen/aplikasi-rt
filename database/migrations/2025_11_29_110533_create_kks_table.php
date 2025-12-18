<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kks', function (Blueprint $table) {
        $table->id();
        $table->string('no_kk');
        $table->string('kepala_keluarga');
        $table->unsignedBigInteger('rt_id');
        $table->unsignedBigInteger('rw_id');
        $table->string('alamat')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kks');
    }
};
