<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shopify_name',
        'product_id',
        'price',
        'order_details',
        'status',
    ];
}
