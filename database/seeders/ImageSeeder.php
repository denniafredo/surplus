<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('image')->insert([
            'name' => "aqua.jpg",
            'file' => "aqua.jpg",
            'enable' => true
        ]);
        DB::table('image')->insert([
            'name' => "cleo.jpg",
            'file' => "cleo.jpg",
            'enable' => true
        ]);
        DB::table('image')->insert([
            'name' => "nasi-goreng.jpg",
            'file' => "nasi-goreng.jpg",
            'enable' => true
        ]);
        DB::table('image')->insert([
            'name' => "mie-goreng.jpg",
            'file' => "mie-goreng.jpg",
            'enable' => true
        ]);
    }
}
