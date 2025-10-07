<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // تأكد من أن الجدول له الهيكل الصحيح
        Schema::table('cart_items', function (Blueprint $table) {
            // إضافة unique constraint إذا مش موجود
            $table->unique(['user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'product_id']);
        });
    }
};