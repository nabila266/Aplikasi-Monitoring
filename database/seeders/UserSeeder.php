<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
          'username' => 'agen',
          'password' => bcrypt('agen1234'),
          'role' => 'agen'
        ]);
        User::create([
          'username' => 'grosir',
          'password' => bcrypt('grosir1234'),
          'role' => 'grosir'
        ]);
    }
}
