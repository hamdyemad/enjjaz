<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    protected $fillable = [
        'name', 'email','phone','title','msg'
    ];

    public function rule(){
        return [
            'email' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'msg' => 'required',
        ];
    }
}
