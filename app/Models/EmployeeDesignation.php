<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDesignation extends Model
{
    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function childDesignations()
    {
        return $this->hasMany(EmployeeDesignation::class, 'parent_id');
    }

    public function parentDesignation()
    {
        return $this->belongsTo(EmployeeDesignation::class, 'parent_id');
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
