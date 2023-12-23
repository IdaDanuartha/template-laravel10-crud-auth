<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        ProductCategory::create([
            "name" => "Shoes"
        ]);
        ProductCategory::create([
            "name" => "Shirt"
        ]);
        ProductCategory::create([
            "name" => "T-Shirt"
        ]);
        ProductCategory::create([
            "name" => "Flannel"
        ]);
    }
}
