<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_products')->insert([
            'product_id' => 1,
            'category_id' => 1,
        ]);
        DB::table('category_products')->insert([
            'product_id' => 2,
            'category_id' => 1,
        ]);
        DB::table('category_products')->insert([
            'product_id' => 3,
            'category_id' => 2,
        ]);
        DB::table('category_products')->insert([
            'product_id' => 4,
            'category_id' => 2,
        ]);
    }
}
