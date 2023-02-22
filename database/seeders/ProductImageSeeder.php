<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_images')->insert([
            'product_id' => 1,
            'image_id' => 1
        ]);
        DB::table('product_images')->insert([
            'product_id' => 2,
            'image_id' => 2
        ]);
        DB::table('product_images')->insert([
            'product_id' => 3,
            'image_id' => 3
        ]);
        DB::table('product_images')->insert([
            'product_id' => 4,
            'image_id' => 4
        ]);
    }
}
