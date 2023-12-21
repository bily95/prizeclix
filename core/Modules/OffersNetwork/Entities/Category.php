<?php

namespace Modules\OffersNetwork\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeIsHome($query)
    {
        return $query->where('at_home', 1);
    }



}
