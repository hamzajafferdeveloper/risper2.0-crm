<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadPipline extends Model
{
    protected $fillable = ['tag_color', 'lead_pipline_id' , 'name', 'is_default'];

    public function Stages(){
        return $this->hasMany(DealStage::class, 'lead_pipline_id');
    }
}
