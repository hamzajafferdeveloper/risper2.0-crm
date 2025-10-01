<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealAgent extends Model
{
    protected $fillable = ['aggent', 'deal_category_id'];

    public function aggent()
    {
        return $this->belongsTo(Employee::class, 'aggent', 'id');
    }

    public function category()
    {
        return $this->belongsTo(DealCategory::class, 'deal_category_id');
    }
}
