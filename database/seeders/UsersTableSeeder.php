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
                'nama' => 'Administrator',
                'email' => 'superadmin@gmail.com',
                'role' => 1,
                'status' => 1,
                'password' => '$2y$10$dvv4bEefS5JvjIzk5djWUuynjQsEtKL/xcBeOlIPANLjtdBBleAQu',
                'hp' => '081234567890',
                'foto' => NULL,
                'remember_token' => NULL,
                'email_verified_at' => '2025-05-03 12:11:16',
                'created_at' => '2025-05-03 12:11:16',
                'updated_at' => '2025-05-03 12:11:16',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}