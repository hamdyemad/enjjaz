<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name', 'order_number','img', 'desc','price','wholePrice'
    ];

    public function img_thum(){
        if (isset($this->img)){
            return url('/upload/img/thum/'.$this->img);
        }
        return url('/upload/no-image.png');
    }

    public function img(){
        if (isset($this->img)){
            return url('/upload/img/'.$this->img);
        }
        return url('/upload/no-image.png');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_products');
    }

}
