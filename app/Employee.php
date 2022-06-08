<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    protected $fillable = [
        'name', 'phone', 'job','type'
    ];

    public function type_list(){
        return ['موظفين','مصممين'];
    }

    public function type(){
        return $this->type_list()[$this->type];
    }
}
