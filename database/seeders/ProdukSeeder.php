<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Produk::create([
        'id_agen' => 1,
        'nama_produk' => 'telur ayam ras a',
        'deskripsi_produk' => 'Telur Ayam Ras A merupakan pilihan tepat bagi Anda yang mengutamakan kualitas dan nutrisi dalam setiap sajian. Dipanen dari ayam-ayam yang sehat dan terawat dengan baik, telur ayam ras A memiliki ukuran yang seragam dan cangkang yang kuat, menjamin kesegaran dan kualitas yang tinggi. Telur ini kaya akan protein, vitamin, dan mineral yang penting bagi kesehatan tubuh, seperti vitamin D, B12, dan zat besi.',
        'harga_produk' => 2900,
        'stok_produk' => 1000,
        'stok_realtime_produk' => 1000,
        'foto_produk' => '/upload/foto_produk/telur-ayam-ras-a.jpg',
      ]);

      Produk::create([
        'id_agen' => 1,
        'nama_produk' => 'telur bebek ras b',
        'deskripsi_produk' => 'Telur Bebek Ras B kami menawarkan cita rasa khas dan kandungan nutrisi yang melimpah, cocok untuk berbagai hidangan istimewa. Telur ini dihasilkan dari bebek-bebek pilihan yang dipelihara dengan standar kualitas tinggi, memastikan setiap butir telur bebas dari bahan kimia dan pestisida.',
        'harga_produk' => 3500,
        'stok_produk' => 1500,
        'stok_realtime_produk' => 1500,
        'foto_produk' => '/upload/foto_produk/telur-bebek-ras-b.jpg',
      ]);
    }
}
