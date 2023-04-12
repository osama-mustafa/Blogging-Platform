<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagsNames = ['programming', 'it', 'hardware', 'networks', 'cyber-security'];
        foreach($tagsNames as $tagName) {
            DB::table('categories')->insert([
                'name' => $tagName
            ]);
        }
    }
}
