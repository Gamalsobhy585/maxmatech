<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create products with all needed information directly in the products table
        $products = [
            [
                'name' => 'Apple iPhone',
                'unit_price' => 999.99,
                'boxes_per_carton' => 10,
                'units_per_box' => 1,
            ],
            [
                'name' => 'Samsung Galaxy',
                'unit_price' => 799.99,
                'boxes_per_carton' => 10,
                'units_per_box' => 1,
            ],
            [
                'name' => 'Sony Headphones',
                'unit_price' => 249.99,
                'boxes_per_carton' => 8,
                'units_per_box' => 1,
            ],
            [
                'name' => 'Dell Laptop',
                'unit_price' => 1299.99,
                'boxes_per_carton' => 5,
                'units_per_box' => 1,
            ],
            [
                'name' => 'HP Printer',
                'unit_price' => 299.99,
                'boxes_per_carton' => 5,
                'units_per_box' => 1,
            ],
            [
                'name' => 'Logitech Mouse',
                'unit_price' => 49.99,
                'boxes_per_carton' => 20,
                'units_per_box' => 5,
            ],
            [
                'name' => 'Microsoft Keyboard',
                'unit_price' => 79.99,
                'boxes_per_carton' => 15,
                'units_per_box' => 3,
            ],
            [
                'name' => 'ASUS Monitor',
                'unit_price' => 349.99,
                'boxes_per_carton' => 4,
                'units_per_box' => 1,
            ],
            [
                'name' => 'Samsung SSD',
                'unit_price' => 129.99,
                'boxes_per_carton' => 25,
                'units_per_box' => 10,
            ],
            [
                'name' => 'Anker Power Bank',
                'unit_price' => 59.99,
                'boxes_per_carton' => 30,
                'units_per_box' => 6,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}