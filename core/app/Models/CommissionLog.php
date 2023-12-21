<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionLog extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function bywho()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
