<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'rtl_status',
        'status'
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
