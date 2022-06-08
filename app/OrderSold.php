<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSold extends Model
{
    //
    protected $fillable = [
        'order_id', 'product_id', 'count','price','price_total'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class, 'product_id');
    }

}
