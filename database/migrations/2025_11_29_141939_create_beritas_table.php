<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('penulis')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps(); // created_at = tanggal posting
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
