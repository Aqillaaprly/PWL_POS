<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'category_id' => 1, 
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Jus',
                'harga_beli' => 7000,
                'harga_jual' => 10000,
            ],
            [
                'category_id' => 1, 
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Mineral Water',
                'harga_beli' => 1500,
                'harga_jual' => 3000,
            ],
            [
                'category_id' => 2, 
                'barang_kode' => 'BRG003',
                'barang_nama' => 'Noodles',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
            ],
            [
                'category_id' => 2, 
                'barang_kode' => 'BRG004',
                'barang_nama' => 'Rice',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
            ],
            [
                'category_id' => 3, 
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Promagh',
                'harga_beli' => 15000,
                'harga_jual' => 30000,
            ],
            [
                'category_id' => 3, 
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Tolak Angin',
                'harga_beli' => 2000,
                'harga_jual' => 5000,
            ],
            [
                'category_id' => 4, 
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Toner',
                'harga_beli' => 35000,
                'harga_jual' => 60000,
            ],
            [
                'category_id' => 4, 
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Mosturaizer',
                'harga_beli' => 20000,
                'harga_jual' => 35000,
            ],
            [
                'category_id' => 5, 
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Blender',
                'harga_beli' => 150000,
                'harga_jual' => 250000,
            ],
            [
                'category_id' => 5, 
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Mixer',
                'harga_beli' => 500000,
                'harga_jual' => 750000,
            ],
        ];
        DB::table('m_barang') ->insert($data);
    }
}
