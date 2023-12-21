<?php

namespace App\Models;

use App\Models\User;
use App\Models\OfferSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfferLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => "datetime:Y-m-d",
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offers()
    {
        return $this->belongsTo(OfferSetup::class, 'offer_id', 'id');
    }
}
