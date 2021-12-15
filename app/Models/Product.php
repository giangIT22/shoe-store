<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PER_PAGE = 10;
    
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function productTags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
