<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name', 
        'email',
        'phone',
        'address',
        'province',
        'payment_method',
        'quantity',
        'total',
        'height',
        'width',
        'user_id'
    ];

    // Define the relationship with the Product model
    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Define the relationship to the User model (One Order belongs to one User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
