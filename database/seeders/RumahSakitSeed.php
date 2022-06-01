<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RumahSakitSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rumah_sakit')->insert([
            'rs_name' => 'Rumah Sakit AMC',
            'rs_address' => 'Jl.AMC',
            'rs_mail' => 'amc@gmail.com',
            'rs_phone' => '0811111119',
        ]);
    }
}
