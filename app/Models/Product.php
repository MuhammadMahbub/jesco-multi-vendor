<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
