<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Deal extends Model
{
    use HasFactory;
    protected $table = 'deals';
    protected $fillable = ['product_id', 'vendor_id', 'validity'];
    function relationtoproduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
