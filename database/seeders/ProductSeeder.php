<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => "Aqua",
            'description' => "Air minum Aqua",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'name' => "Cleo",
            'description' => "Air minum Cleo",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'name' => "Nasi Goreng",
            'description' => "Nasi Goreng Mantab",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('products')->insert([
            'name' => "Mie Goreng",
            'description' => "Mie Goreng Jos",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
