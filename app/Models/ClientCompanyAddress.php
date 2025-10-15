<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class ClientCompanyAddress extends Model
{
    protected $fillable =[
        'client_id',
        'name',
        'website',
        'tax_name',
        'tax_number',
        'office_phone_number',
        'state',
        'city',
        'postal_code',
        'address',
        'shipping_address',
        'note',
        'logo',
        'added_by',
    ];

    public function addedBy()
    {
        return $this->belongsTo(Employee::class, 'added_by');
    }

}
