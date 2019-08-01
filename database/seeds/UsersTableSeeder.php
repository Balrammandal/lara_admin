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
            'f_name' => 'John',
            'l_name' => 'Doe',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'user_type' => 'Admin',
            'status' => 'Active',
        ]);
    }
}
