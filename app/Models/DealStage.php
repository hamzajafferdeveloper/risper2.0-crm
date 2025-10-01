<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealStage extends Model
{
    use HasFactory;
    protected $fillable = ['tag_color', 'lead_pipline_id', 'name', 'is_default'];

    public function leadPipline(){
        return $this->belongsTo(LeadPipline::class, 'lead_pipline_id');
    }
}
