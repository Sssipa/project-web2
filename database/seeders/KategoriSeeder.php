<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['name' => 'Elektronik'],
            ['name' => 'Fashion'],
            ['name' => 'Otomotif'],
            ['name' => 'Kesehatan'],
            ['name' => 'Lainnya'],
        ];

        DB::table('kategoris')->insert($kategori);
    }
}
