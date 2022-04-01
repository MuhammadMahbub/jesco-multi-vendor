<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'product_price', 'product_discount', 'product_short_description', 'product_long_description', 'product_code', 'product_photo', 'product_slug', 'product_quantity',
    ];

    function relationtouser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    function relationtocategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    function relationtodeal()
    {
        return $this->hasOne(Deal::class, 'product_id', 'id');
    }
}
