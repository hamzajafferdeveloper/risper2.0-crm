<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'lead_id',
        'name',
        'pipe_line_id',
        'deal_stage_id',
        'currency_id',
        'deal_value',
        'close_date',
        'deal_category_id',
        'deal_aggent_id',
        'deal_watcher_id'
    ];
}
