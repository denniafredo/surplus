<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            'name' => "aqua.jpg",
            'file' => "aqua.jpg",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('images')->insert([
            'name' => "cleo.jpg",
            'file' => "cleo.jpg",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('images')->insert([
            'name' => "nasi-goreng.jpg",
            'file' => "nasi-goreng.jpg",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('images')->insert([
            'name' => "mie-goreng.jpg",
            'file' => "mie-goreng.jpg",
            'enable' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')

        ]);
    }
}
