<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // ← السطر المهم ده
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء مستخدم تجريبي
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // تشغيل الـ ProductSeeder
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
