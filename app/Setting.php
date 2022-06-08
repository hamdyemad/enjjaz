<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
        'about_us','email','facebook','terms','website',
        'whatsapp','address','twitter','instgram','privacy'
    ];

    public function rule(){
        return [
            'address' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
        ];
    }
}
