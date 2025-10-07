<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
