<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
        'name' => 'Nguyen Duy Dat',
        'email' => 'datnd@gmail.com',
        'password' => bcrypt('tuyem123'),
        'type' => '1',
    ]);
    }
}
