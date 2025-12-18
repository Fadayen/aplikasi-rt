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
    Schema::table('users', function (Blueprint $table) {
        $table->string('nik')->nullable();
        $table->string('no_kk')->nullable();
        $table->text('alamat')->nullable();
        $table->string('no_telpon')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['nik', 'no_kk', 'alamat', 'no_telpon']);
    });
}

};
