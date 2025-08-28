<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone X1',
                'price' => 299.99,
                'category' => 'Electronics',
                'discount' => 10,
                'description' => 'Latest smartphone with advanced features, high-resolution camera, and long battery life.',
                'image' => 'products/iphoneX1.jpg',
            ],
            [
                'name' => 'Wireless Headphones',
                'price' => 89.99,
                'category' => 'Electronics',
                'discount' => 0,
                'description' => 'Premium wireless headphones with noise cancellation and 30-hour battery life.',
                'image' => 'products/Wireless Headphones.jpg',
            ],
            [
                'name' => 'Laptop Pro',
                'price' => 1299.99,
                'category' => 'Electronics',
                'discount' => 15,
                'description' => 'Professional laptop with high performance, large storage, and excellent display.',
                'image' => 'products/Laptop Pro.jpg',
            ],
            [
                'name' => 'Running Shoes',
                'price' => 79.99,
                'category' => 'Sports',
                'discount' => 20,
                'description' => 'Comfortable running shoes with excellent cushioning and breathable design.',
                'image' => 'products/Running Shoes.jpg',
            ],
            [
                'name' => 'Yoga Mat',
                'price' => 29.99,
                'category' => 'Sports',
                'discount' => 0,
                'description' => 'Premium yoga mat with non-slip surface and comfortable thickness.',
                'image' => 'products/Yoga Mat.jpg',
            ],
            [
                'name' => 'Coffee Maker',
                'price' => 149.99,
                'category' => 'Home & Kitchen',
                'discount' => 5,
                'description' => 'Automatic coffee maker with programmable timer and large capacity.',
                'image' => 'products/Coffee Maker.jpg',
            ],
            [
                'name' => 'Blender',
                'price' => 59.99,
                'category' => 'Home & Kitchen',
                'discount' => 0,
                'description' => 'High-speed blender perfect for smoothies, soups, and food processing.',
                'image' => 'products/Blender.jpg',
            ],
            [
                'name' => 'T-Shirt',
                'price' => 24.99,
                'category' => 'Fashion',
                'discount' => 0,
                'description' => 'Comfortable cotton t-shirt available in multiple colors and sizes.',
                'image' => 'products/T-Shirt.jpg',
            ],
            [
                'name' => 'Jeans',
                'price' => 49.99,
                'category' => 'Fashion',
                'discount' => 25,
                'description' => 'Classic denim jeans with modern fit and durable construction.',
                'image' => 'products/Jeans.jpg',
            ],
            [
                'name' => 'Sneakers',
                'price' => 69.99,
                'category' => 'Fashion',
                'discount' => 10,
                'description' => 'Stylish sneakers perfect for casual wear and light activities.',
                'image' => 'products/Sneakers.jpg',
            ],
            [
                'name' => 'Backpack',
                'price' => 39.99,
                'category' => 'Fashion',
                'discount' => 0,
                'description' => 'Spacious backpack with multiple compartments and laptop sleeve.',
                'image' => 'products/Backpack.jpg',
            ],
            [
                'name' => 'Watch',
                'price' => 199.99,
                'category' => 'Fashion',
                'discount' => 15,
                'description' => 'Elegant watch with stainless steel band and water resistance.',
                'image' => 'products/Watch.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
