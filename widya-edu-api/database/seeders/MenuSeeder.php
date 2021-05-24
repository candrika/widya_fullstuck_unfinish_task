<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('menu')->insert([
            'menu_name' => 'Master Bank Soal',
            'parent' => 0,
            'link_menu' => '/master/bank_soal',
            'display' => 0,
        ]);
    }
}
