<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;

    public function relationwithvendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function relationwithproduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
