<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{

    protected $table = 'order_products';
    use SoftDeletes;

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

    public function remaining_count(){
        $sold=OrderSold::where([['product_id',$this->product_id],['order_id',$this->order_id]])->first();
        $c_s=isset($sold) ? $sold->count :0;
        $recieve=OrderRecieve::where([['product_id',$this->product_id],['order_id',$this->order_id]])->first();
        $c_r=isset($recieve) ? $recieve->count :0;
        return $this->count - $c_s - $c_r;
    }

}
