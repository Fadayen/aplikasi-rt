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
    Schema::create('wargas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kk_id');
        $table->string('nama');
        $table->string('nik')->unique();
        $table->string('jenis_kelamin');
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('agama')->nullable();
        $table->string('pendidikan')->nullable();
        $table->string('pekerjaan')->nullable();
        $table->string('status_kawin')->nullable();
        $table->string('status_hubungan')->nullable(); // kepala keluarga, anak, istri, dll
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
