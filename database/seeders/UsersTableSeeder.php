<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'fakhrurrazi',
                'email' => 'fakhrurrazi.code@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$quKvr.ovlaUzmtAz58rm/uKd6gYyu8ER42Cze8d2J0nw82Npt.u4i',
                'is_admin' => 1,
                'pegawai_id' => 3,
                'remember_token' => NULL,
                'created_at' => '2022-06-10 02:41:42',
                'updated_at' => '2022-06-10 02:41:42',
            ),
        ));
        
        
    }
}