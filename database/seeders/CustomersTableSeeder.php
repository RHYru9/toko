<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 4,
                'google_id' => '118125924815964966610',
                'google_token' => 'ya29.x-xxxx-xxxxx',
                'name' => 'rhy0z Dz',
                'email' => 'rhyfk0z@gmail.com',
                'password' => '$2y$10$N8bHWKUJwp2ksOEY5C472.uo564VL4kW4Ew7xR17hxo6B866.5Ou.',
                'hp' => NULL,
                'alamat' => NULL,
                'pos' => NULL,
                'foto' => 'https://lh3.googleusercontent.com/a/ACg8ocLvBEeiRgI8z0VV9kcQZYRtBlyUzFnziMDzLJ8jcPRVGr6BPA=s96-c',
                'remember_token' => NULL,
                'email_verified_at' => NULL,
                'created_at' => '2025-05-03 12:11:16',
                'updated_at' => '2025-05-03 12:11:29',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
