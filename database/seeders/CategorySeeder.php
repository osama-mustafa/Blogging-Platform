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
        $categoriesNames = ['programming', 'it', 'hardware', 'networks', 'cyber-security'];
        foreach($categoriesNames as $categoryName) {
            DB::table('categories')->insert([
                'name' => $categoryName
            ]);
        }
    }
}
