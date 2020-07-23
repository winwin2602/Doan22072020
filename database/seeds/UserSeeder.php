<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	        'email' => 'admin@gmail.com',
	        'name' => 'Administrator',
	        'password' => bcrypt('Matkhau1*'),
	        'level'=> 0,
	        'created_at' => Carbon::now(),
	        'updated_at' => Carbon::now(),
	        'is_deleted' => 0
        ]);
        DB::table('users')->insert([
	        'email' => 'toan160798@gmail.com',
	        'name' => 'ToanBT',
	        'level' => 1,
	        'password' => bcrypt('Matkhau1*'),
	        'created_at' => Carbon::now(),
	        'updated_at' => Carbon::now(),
	        'is_deleted' => 0
        ]);
        DB::table('users')->insert([
	        'email' => 'phuchoi@gmail.com',
	        'name' => 'HoiNP',
	        'level' => 2,
	        'password' => bcrypt('Matkhau1*'),
	        'created_at' => Carbon::now(),
	        'updated_at' => Carbon::now(),
	        'is_deleted' => 0
        ]);
        DB::table('users')->insert([
	        'email' => 'dinhnghia@gmail.com',
	        'name' => 'NghiaDT',
	        'level' => 3,
	        'password' => bcrypt('Matkhau1*'),
	        'created_at' => Carbon::now(),
	        'updated_at' => Carbon::now(),
	        'is_deleted' => 0
        ]);
    }
}
