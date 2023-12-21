<?php

namespace Modules\OffersNetwork\Entities;

use App\Models\User;
use App\Models\OfferSetup;
use Illuminate\Database\Eloquent\Model;
use Modules\OffersNetwork\Entities\OffersStorage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffersTrack extends Model
{
    use HasFactory;

    protected $table = 'offer_tracks';

    protected $guarded = [];
    
    /**
     * Get the offer that owns the OffersTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer(): BelongsTo
    {
        return $this->belongsTo(OffersStorage::class, 'offer_id', 'id');
    }

    /**
     * Get the user that owns the OffersTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get the provider that owns the OffersTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(OfferSetup::class, 'provider_id', 'id');
    }

}
