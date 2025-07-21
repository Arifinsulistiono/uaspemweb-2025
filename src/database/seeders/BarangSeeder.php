<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::insert([
            [
                'nama' => 'Proyektor Epson',
                'stok' => 10,
                'satuan' => 'unit',
            ],
            [
                'nama' => 'Laptop Lenovo',
                'stok' => 5,
                'satuan' => 'unit',
            ],
            [
                'nama' => 'Kabel HDMI',
                'stok' => 20,
                'satuan' => 'buah',
            ],
        ]);
    }
}
