<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data barang
        $barangs = [
            [
                'user_id' => 1,
                'kategori_id' => 1, // Elektronik
                'nama' => 'Smartphone Samsung Galaxy S21',
                'deskripsi' => 'Smartphone flagship dengan layar AMOLED dan kamera 108MP.',
                'harga' => 7500000,
                'gambar' => 'samsung-galaxy-s21.jpg',
                'status' => 'tersedia',
            ],
            [
                'user_id' => 2,
                'kategori_id' => 2, // Fashion
                'nama' => 'Jaket Kulit Asli',
                'deskripsi' => 'Jaket kulit asli premium untuk tampilan stylish.',
                'harga' => 1200000,
                'gambar' => 'jaket-kulit.jpg',
                'status' => 'tersedia',
            ],
            [
                'user_id' => 2,
                'kategori_id' => 3, // Otomotif
                'nama' => 'Helm Motor Full Face',
                'deskripsi' => 'Helm motor full face standar SNI untuk keamanan maksimal.',
                'harga' => 450000,
                'gambar' => 'helm-motor.jpg',
                'status' => 'tersedia',
            ],
            [
                'user_id' => 1,
                'kategori_id' => 4, // Kesehatan
                'nama' => 'Alat Ukur Tekanan Darah',
                'deskripsi' => 'Alat digital untuk mengukur tekanan darah di rumah.',
                'harga' => 300000,
                'gambar' => 'tensi-meter.jpg',
                'status' => 'tersedia',
            ],
            [
                'user_id' => 2,
                'kategori_id' => 5, // Lainnya
                'nama' => 'Rak Buku Minimalis',
                'deskripsi' => 'Rak buku kayu minimalis cocok untuk dekorasi rumah.',
                'harga' => 600000,
                'gambar' => 'rak-buku.jpg',
                'status' => 'tersedia',
            ],
        ];

        DB::table('barangs')->insert($barangs);
    }
}
