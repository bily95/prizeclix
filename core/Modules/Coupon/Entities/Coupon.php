<?php

namespace Modules\Coupon\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    /**
     * Get all of the comments for the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function log()
    {
        return $this->hasMany(CouponLog::class, 'coupon_id', 'id');
    }

}
