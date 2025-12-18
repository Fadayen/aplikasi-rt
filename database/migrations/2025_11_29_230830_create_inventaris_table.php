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
    Schema::create('inventaris', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang');
        $table->string('tipe')->nullable();
        $table->integer('jumlah');
        $table->string('lokasi');
        $table->date('tanggal_masuk');
        $table->enum('kondisi', ['baru', 'baik', 'rusak']);
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
