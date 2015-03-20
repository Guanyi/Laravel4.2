<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends \Illuminate\Database\Seeder{
    public function run() {
        DB::table('users')->delete();

        $users = array(
            array(
                'id' => 'example@example.com',
                'password' => Hash::make('12345'),
                'active' => false
            ),

            array(
                'id' => 'test@test.com',
                'password' => Hash::make('abcde'),
                'active' => false
            )
        );

        DB::table('users')->insert($users);
    }
}