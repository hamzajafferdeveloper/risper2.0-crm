<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'code',
        'is_cryptocurrency',
        'is_default',
        'exchange_rate',
        'currency_position',
        'thousand_separator',
        'decimal_separator',
        'number_of_decimal'
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
