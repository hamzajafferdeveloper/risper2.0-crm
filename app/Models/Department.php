<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function childDepartments()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
