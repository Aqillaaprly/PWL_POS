<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['category_id' => 1, 'category_code' =>'DRK', 'category_name' => 'Drink'],
            ['category_id' => 2, 'category_code' =>'FOD', 'category_name' => 'Food'],
            ['category_id' => 3, 'category_code' =>'HLT', 'category_name' => 'Health'],
            ['category_id' => 4, 'category_code' =>'SKC', 'category_name' => 'SkinCare'],
            ['category_id' => 5, 'category_code' =>'ELC', 'category_name' => 'Electronic'],
        ];
        DB::table('m_category') ->insert($data);
    }
}
