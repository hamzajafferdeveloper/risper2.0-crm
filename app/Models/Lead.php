<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'salutation',
        'name',
        'email',
        'lead_source_id',
        'added_by',
        'lead_owner',
        'auto_convert_lead_to_client'
    ];

    public function leadOwner()
    {
        return $this->belongsTo(Employee::class, 'lead_owner', 'id');
    }

    public function leadAddedBy(){
        return $this->belongsTo(Employee::class,'added_by', 'id');
    }

    public function source()
    {
        return $this->belongsTo(LeadSource::class, 'lead_source_id');
    }
}
