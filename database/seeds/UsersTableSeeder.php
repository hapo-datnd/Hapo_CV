<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nguyen Duy Dat',
            'email' => 'dat@gmail.com',
            'password' => bcrypt('tuyem123'),
            'type' => '1',
        ]);
    }
}
