<?php

namespace Database\Seeders;

use App\Models\TelurExpired;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelurExpiredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      TelurExpired::create([
        'id_produk' => 1,
        'stok_masuk' => 1000,
        'tanggal_restok' => DB::raw('CURRENT_DATE'),
        'tanggal_kedaluwarsa' => DB::raw('DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY)'),
      ]);

      TelurExpired::create([
        'id_produk' => 2,
        'stok_masuk' => 1500,
        'tanggal_restok' => DB::raw('CURRENT_DATE'),
        'tanggal_kedaluwarsa' => DB::raw('DATE_ADD(CURRENT_DATE, INTERVAL 40 DAY)'),
      ]);
    }
}
