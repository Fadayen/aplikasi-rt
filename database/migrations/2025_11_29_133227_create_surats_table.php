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
    Schema::create('surats', function (Blueprint $table) {
        $table->id();
        $table->string('no_surat');
        $table->date('tanggal');
        $table->string('status_kawin');
        $table->string('pelayanan');
        $table->string('pekerjaan');
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
