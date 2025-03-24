<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_supplier')->insert([
            [
                'nama_supplier' => 'PT. Makmur',
                'email' => 'sumbermakmur@email',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_supplier' => 'CV. Jaya',
                'email' => 'majuyaya@email',
                'telepon' => '081987654321',
                'alamat' => 'Jl. Raya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_supplier' => 'PT. Maju',
                'email' => 'sejahtermajua@email',
                'telepon' => '081112223344',
                'alamat' => 'Jl. Pahlawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}