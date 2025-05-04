<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'superadmin@gmail.com',
            'role' => '1',
            'status' => 1,
            'password' => bcrypt('xxxxxx'),
        ]);


        User::create([
        'nama' => 'rey admin',
        'email' => 'reyhansyah4@mail.com',
        'role' => '1',
        'status' => 1,
        'password' => bcrypt('xxxxxx'),
        ]);

        User::create([
            'nama' => 'reyuser',
            'email' => 'reyuser@gmail.com',
            'role' => '2',
            'status' => 1,
            'password' => bcrypt('xxxxxx'),
            ]);
            # Data Kategori
            Kategori::create([
                'nama_kategori' => 'Brownies',
            ]);
                Kategori::create([
                'nama_kategori' => 'Combro',
            ]);
                Kategori::create([
                'nama_kategori' => 'Dawet',
            ]);
                Kategori::create([
                'nama_kategori' => 'Mochi',
            ]);
                Kategori::create([
                'nama_kategori' => 'Wingko',
            ]);
        $this->call(CustomersTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(FotoProdukTableSeeder::class);
        $this->call(KategoriTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(PasswordResetTokensTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
