<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'link',
        'status',
        'page',
        'user_id',
        'company_id',
    ];
}
