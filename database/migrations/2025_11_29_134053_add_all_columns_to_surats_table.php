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
    Schema::table('surats', function (Blueprint $table) {
        if (!Schema::hasColumn('surats', 'no_surat')) {
            $table->string('no_surat')->nullable();
        }
        if (!Schema::hasColumn('surats', 'tanggal')) {
            $table->date('tanggal')->nullable();
        }
        if (!Schema::hasColumn('surats', 'status_kawin')) {
            $table->string('status_kawin')->nullable();
        }
        if (!Schema::hasColumn('surats', 'pelayanan')) {
            $table->string('pelayanan')->nullable();
        }
        if (!Schema::hasColumn('surats', 'pekerjaan')) {
            $table->string('pekerjaan')->nullable();
        }
        if (!Schema::hasColumn('surats', 'status')) {
            $table->string('status')->default('pending');
        }
    });
}

public function down()
{
    Schema::table('surats', function (Blueprint $table) {
        $table->dropColumn([
            'no_surat',
            'tanggal',
            'status_kawin',
            'pelayanan',
            'pekerjaan',
            'status'
        ]);
    });
}

};
