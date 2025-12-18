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
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('isi')->nullable();
        $table->string('kategori')->nullable(); // kegiatan / keuangan / pengaduan
        $table->unsignedBigInteger('rt_id')->nullable();
        $table->unsignedBigInteger('rw_id')->nullable();
        $table->date('tanggal')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
