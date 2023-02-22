<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product')->insert([
            'name' => "Aqua",
            'description' => "Air minum Aqua",
            'enable' => true
        ]);
        DB::table('product')->insert([
            'name' => "Cleo",
            'description' => "Air minum Cleo",
            'enable' => true
        ]);
        DB::table('product')->insert([
            'name' => "Nasi Goreng",
            'description' => "Nasi Goreng Mantab",
            'enable' => true
        ]);
        DB::table('product')->insert([
            'name' => "Mie Goreng",
            'description' => "Mie Goreng Jos",
            'enable' => true
        ]);
    }
}
