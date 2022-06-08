<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;

    //
    protected $fillable = [
        'customer_id', 'notes', 'status','from','user_id','voice_status'
    ];

    static public function status_list(){
        return ['جديد','فاتورة سارية','تم التسليم','ملغية','مدفوعة'];
    }

    public function status(){
        $s=$this->status_list();
        return $s[$this->status];
    }

    public function voice_status(){
        $s=$this->status_list();
        return $s[$this->voice_status];
    }

    public function orderStatus() {
        return $this->hasMany(OrderStatus::class, 'order_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }


    public function products(){
        return $this->hasMany(OrderProduct::class,'order_id');
    }

    public function productsCount() {
        return $this->products->pluck('count')->sum();
    }

    public function solds(){
        return $this->hasMany(OrderSold::class,'order_id');
    }

    public function recieves(){
        return $this->hasMany(OrderRecieve::class,'order_id');
    }

    public function payments(){
        return $this->hasMany(OrderPayment::class,'order_id');
    }

    public function total_price(){
        return $this->products()->sum('price_total');
    }

    public function total_payment(){
        return $this->payments()->sum('price');
    }

    public function total_price_solds(){
        return $this->solds()->sum('price_total') ?? 0;
    }

    public function total_price_recieve(){
        return $this->recieves()->sum('price_total') ?? 0;
    }

    public function remaining(){
        return $this->total_price() - $this->total_price_solds() - $this->total_price_recieve();
    }

    public function products_name(){
        $name=' ';
        foreach($this->products()->get() as $product){
            $name .= '-'.$product->product->name .':'. $product->count ?? '' .':'. $product->count;
        }
        return $name;
    }



}
