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
        'deal_agent_id',
        'deal_watcher_id',
    ];

    public function leadOwner()
    {
        return $this->belongsTo(Employee::class, 'lead_owner_id');
    }

    public function dealAgent()
    {
        return $this->belongsTo(DealAgent::class, 'deal_agent_id', 'id')->with('aggentEmployee');
    }

    public function dealsCategory()
    {
        return $this->belongsTo(DealCategory::class, 'deal_category_id');
    }

    public function dealStage()
    {
        return $this->belongsTo(DealStage::class, 'deal_stage_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function dealWatcher()
    {
        return $this->belongsTo(Employee::class, 'deal_watcher_id');
    }
}
