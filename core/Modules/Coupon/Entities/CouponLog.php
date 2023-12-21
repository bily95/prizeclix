<?php

namespace Modules\Coupon\Entities;

use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the CouponLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(ModelsUser::class, 'user_id', 'id');
    }

    /**
     * Get the user that owns the CouponLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
    
}
