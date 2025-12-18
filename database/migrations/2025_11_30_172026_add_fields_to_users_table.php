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

        if (!Schema::hasColumn('users', 'username')) {
            $table->string('username')->nullable();
        }
        if (!Schema::hasColumn('users', 'nama_lengkap')) {
            $table->string('nama_lengkap')->nullable();
        }
        if (!Schema::hasColumn('users', 'no_kk')) {
            $table->string('no_kk')->nullable();
        }
        if (!Schema::hasColumn('users', 'nik')) {
            $table->string('nik')->nullable();
        }
        if (!Schema::hasColumn('users', 'tempat_lahir')) {
            $table->string('tempat_lahir')->nullable();
        }
        if (!Schema::hasColumn('users', 'tanggal_lahir')) {
            $table->date('tanggal_lahir')->nullable();
        }
        if (!Schema::hasColumn('users', 'agama')) {
            $table->string('agama')->nullable();
        }
        if (!Schema::hasColumn('users', 'jenis_kelamin')) {
            $table->string('jenis_kelamin')->nullable();
        }
        if (!Schema::hasColumn('users', 'no_hp')) {
            $table->string('no_hp')->nullable();
        }
        if (!Schema::hasColumn('users', 'alamat')) {
            $table->text('alamat')->nullable();
        }
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('warga');
        }
        if (!Schema::hasColumn('users', 'is_approved')) {
            $table->boolean('is_approved')->default(false);
        }

    });
}


public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'username',
            'nama_lengkap',
            'no_kk',
            'nik',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'jenis_kelamin',
            'no_hp',
            'alamat',
            'role',
            'is_approved',
        ]);
    });
}

};
