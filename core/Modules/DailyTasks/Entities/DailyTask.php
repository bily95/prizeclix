<?php

namespace Modules\DailyTasks\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\DailyTasks\Entities\DailyTaskLog;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DailyTask extends Model
{
    protected $table = 'daily_tasks';
    
    protected $guarded = ['id'];

    /**
     * Get all of the logs for the DailyTask
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(DailyTaskLog::class, 'task_id', 'id');
    }
    
}
