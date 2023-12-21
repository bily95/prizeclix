<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveChat extends Model
{
    protected $table = 'live_chat';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
