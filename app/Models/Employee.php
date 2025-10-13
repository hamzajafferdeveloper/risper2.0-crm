<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'employee_id',
        'salutation',
        'name',
        'email',
        'profile_pic',
        'password',
        'designation_id',
        'department_id',
        'country_id',
        'mobile',
        'gender',
        'joining_date',
        'date_of_birth',
        'reporting_to',
        'language_id',
        'address',
        'about',
        'login_allowed',
        'receive_email_notification',
        'slack_member_id',
        'probation_end_date',
        'notice_period_start_date',
        'notice_period_end_date',
        'currency_id',
        'hourly_rate',
        'employee_type_id',
        'marital_status',
        'business_address_id',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'skills' => 'array', // <-- this is required
        'joining_date' => 'date:Y-m-d',
        'date_of_birth' => 'date:Y-m-d',
        'probation_end_date' => 'date:Y-m-d',
        'notice_period_start_date' => 'date:Y-m-d',
        'notice_period_end_date' => 'date:Y-m-d',
    ];

    public function reportingTo()
    {
        return $this->belongsTo(Employee::class, 'reporting_to');
    }

    public function designation()
    {
        return $this->belongsTo(EmployeeDesignation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function businessAddress()
    {
        return $this->belongsTo(BusinessAddress::class);
    }
}
