<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Mussab ElDash',
            'email' => 'mussab@example.com',
            'password' => '$2y$10$g9mhxGqOECrjI0g/hbo7X.o8eThIZNRyoqvYsXULdHDJvsQWvRmoy',
            'remember_token' => 'ryTVYiDGY4UdFQl8M0yO406MK0WO9imJC62MohqBJkO8ytfsn5Y1PtdWA2k1',
            'created_at' => '2016-04-02 23:55:02',
            'updated_at' => '2016-04-02 23:55:21',
            'role' => 'Admin',
            'gender' => true
        ]);
    }
}