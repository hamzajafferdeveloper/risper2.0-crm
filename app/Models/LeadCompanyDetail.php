<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadCompanyDetail extends Model
{
    protected $fillable =[
        'lead_id',
        'name',
        'website',
        'mobile',
        'office_phone_number',
        'country_id',
        'state',
        'city',
        'postal_code',
        'address'
    ];
}
