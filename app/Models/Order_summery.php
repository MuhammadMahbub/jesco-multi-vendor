<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_summery extends Model
{
    use HasFactory;

    protected $fillable = ['delivered_status'];

    function relationwithuser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
