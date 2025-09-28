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
}
