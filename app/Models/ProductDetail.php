<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'product_details';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
