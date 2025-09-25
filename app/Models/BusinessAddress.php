<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAddress extends Model
{
    protected $fillable = [
        'country_id',
        'location',
        'tax_name',
        'tax_number',
        'address',
        'latitude',
        'longitude',
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
