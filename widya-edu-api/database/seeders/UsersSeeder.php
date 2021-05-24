<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'ekacandrika@gmail.com',
            'realname' => 'Candrika Eka Kurniawan',
            'password'=>'nasipadang',
            'roles_id' => 1,
            'display' => 1
        ]);
    }
}
