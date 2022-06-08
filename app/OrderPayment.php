<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    //
    protected $fillable = [
        'order_id', 'admin_id','price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
