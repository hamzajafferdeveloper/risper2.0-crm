<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMembers extends Model
{
    protected $fillable = ['project_id', 'member_id'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members');
    }
}
