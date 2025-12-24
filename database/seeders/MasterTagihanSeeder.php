<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterTagihanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_tagihans')->updateOrInsert(
            ['nama_tagihan' => 'Kas Bulanan'], // kunci unik
            [
                'nominal_biasa' => 50000,
                'nominal_vip'   => 100000,
                'aktif'         => 1,
                'updated_at'    => Carbon::now(),
                'created_at'    => Carbon::now(),
            ]
        );
    }
}
