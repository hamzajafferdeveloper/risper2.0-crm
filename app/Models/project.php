<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $fillable = [
        'short_code',
        'name',
        'start_date',
        'end_date',
        'has_end_date',
        'category_id',
        'department_id',
        'client_id',
        'summary',
        'note',
        'public_gantt_chart',
        'public_task_board',
        'task_need_approval',
        'file',
        'currency_id',
        'budget',
        'estimated_hours',
        'calculate_progress',
        'allow_manual_timelog',
        'enable_microboard',
        'micro_board_id',
        'client_can_access_micro',
        'calculate_progress',
        'progress',
        'send_task_notification_to_client',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'project_members');
    }
}
