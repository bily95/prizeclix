<?php

namespace Modules\Leaderboard\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LeaderboardLog extends Model
{

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => "datetime:Y-m-d",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
