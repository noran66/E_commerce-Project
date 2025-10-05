<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function colors() {
        return $this->hasMany(Color::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
