<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    //
    protected $fillable = [
        'status', 'user_id', 'reason'
    ];

    static public function status_list(){
        return ['جديد','فاتورة سارية','تم التسليم','ملغية','مدفوعة'];
        }

    public function status(){
        $s=$this->status_list();
        return $s[$this->status];
    }
    
}
