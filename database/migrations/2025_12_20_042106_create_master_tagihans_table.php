<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tagihan');
            $table->integer('nominal_biasa');
            $table->integer('nominal_vip');
            $table->boolean('aktif')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_tagihans');
    }
};

