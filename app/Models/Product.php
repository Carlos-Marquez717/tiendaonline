<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio'];

    // Relación con las imágenes
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

}
