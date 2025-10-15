<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
        protected $fillable = [
        'salutation',
        'name',
        'email',
        'profile_pic',
        'password',
        'country_id',
        'mobile',
        'gender',
        'category_id',
        'sub_category_id',
        'language_id',
        'login_allowed',
        'receive_email_notification',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function companyAddress()
    {
        return $this->hasOne(ClientCompanyAddress::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function category(){
        return $this->belongsTo(ClientCategory::class);
    }

    public function subCategory(){
        return $this->belongsTo(ClientCategory::class, 'sub_category_id');
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
