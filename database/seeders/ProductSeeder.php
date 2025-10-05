<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Color;
use App\Models\Review;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // إنشاء مستخدم تجريبي
        $user = User::firstOrCreate([
            'email' => 'user@example.com'
        ], [
            'name' => 'John Doe',
            'password' => bcrypt('password123')
        ]);

        // إنشاء منتج
        $product = Product::create([
            'name' => 'Nordic Chair',
            'price' => 149,
            'old_price' => 199,
            'stock' => 10,
            'description' => 'This classic watch combines elegance and durability, perfect for any occasion.',
            'material' => 'Stainless Steel',
            'weight' => '150g',
            'dimensions' => '40mm x 40mm x 10mm',
            'image' => 'product-3.png'
        ]);

        // إضافة ألوان للمنتج
        $colors = [
            ['name' => 'Black', 'code' => '#000000'],
            ['name' => 'White', 'code' => '#14670eff'],
            ['name' => 'Red', 'code' => '#ff0000'],
        ];

        foreach ($colors as $c) {
            $product->colors()->create($c);
        }

        // إضافة مراجعة للمنتج
        Review::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => 4,
            'comment' => 'Great watch! Highly recommend it.'
        ]);

        Review::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => 5,
            'comment' => 'Excellent quality and fast shipping.'
        ]);
    }
}
