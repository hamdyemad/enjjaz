<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable = [
        'title', 'price', 'type','date','employee_id'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function type_list(){
        return ['موظفين',
        'مصممين',
        'التزامات مالية',
        'مصروفات أخرى'];
    }

    public function type(){
        return $this->type_list()[$this->type];
    }
}
