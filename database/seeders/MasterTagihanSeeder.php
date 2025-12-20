<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterTagihanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_tagihans')->insert([
            [
                'nama_tagihan'   => 'Kas Bulanan',
                'nominal_biasa'  => 50000,
                'nominal_vip'    => 100000,
                'aktif'          => 1,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);
    }
}
