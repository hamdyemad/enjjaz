<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    protected $fillable = [
        'product_id', 'price', 'client_name','type','count','copy_no','date','total_price', 'order_number'
    ];

    public function product(){
        return $this->BelongsTo(Product::class,'product_id');
    }
}
