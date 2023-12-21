<?php

namespace Modules\DailyTasks\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyTaskLog extends Model
{

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => "datetime:Y-m-d",
    ];
    /**
     * Get the user that owns the DailyTaskLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the task that owns the DailyTaskLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(DailyTask::class, 'task_id', 'id');
    }

}
