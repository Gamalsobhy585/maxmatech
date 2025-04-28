<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Box'],
            ['name' => 'Carton'],
            ['name' => 'Piece'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
