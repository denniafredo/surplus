<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            'name' => "Minuman",
            'enable' => true
        ]);
        DB::table('category')->insert([
            'name' => "Makanan",
            'enable' => true
        ]);
    }
}
