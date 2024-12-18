<?php

namespace Database\Seeders;

use App\Models\Agen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Agen::create([
        'id_user' => 1,
        'nama_agen' => 'agen',
        'nomor_telefon_agen' => '081234567890',
        'alamat_agen' => 'Jl. Haji Mutholib no. 32',
      ]);
    }
}
