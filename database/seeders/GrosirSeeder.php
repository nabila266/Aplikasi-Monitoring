<?php

namespace Database\Seeders;

use App\Models\Grosir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrosirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grosir::create([
          'id_user' => 2,
          'nama_grosir' => 'grosir',
          'nomor_telefon_grosir' => '081234567890',
          'alamat_grosir' => 'Jl. Haji Mubarok no. 23',
        ]);
    }
}
