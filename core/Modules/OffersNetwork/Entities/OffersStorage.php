<?php

namespace Modules\OffersNetwork\Entities;

use App\Models\OfferSetup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffersStorage extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the provider that owns the OffersStorage
     *
     * @return BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(OfferSetup::class, 'provider_id', 'id');
    }

    /**
     * Get all of the track for the OffersStorage
     *
     * @return HasMany
     */
    public function track()
    {
        return $this->hasMany(OffersTrack::class, 'offer_id', 'id');
    }

    public function scopeFilter($query)
    {

        $userOffers = OffersTrack::where('user_id', auth()->id())
            ->where('is_completed', '!=', 0)
            ->pluck('offer_id')->toArray();


        $offers = $query->whereNotIn('id', $userOffers)
            ->where('is_completed', 0)
            ->active()
            ->byCountry()
            ->byDevice();

        return $offers->with(['provider:id,name']);
    }

    public function scopeByCountry($query)
    {
        $userCountry = is_local() ? 'EG' : getIpInfo()['code'];

        return $query->where(function ($q) use ($userCountry) {
            return $q->where('country', 'like', '%' . $userCountry . '%')
                ->orWhere('country', 'like', '%all%')
                ->orWhere('country', 'like', '%*%');
        });
    }

    public function scopeByDevice($query)
    {
        $userPlatform = getDeviceType();

        return $query->where(function ($q) use ($userPlatform) {
            return $q->where('device', 'like', '%' . $userPlatform . '%')
                ->orWhere('device', 'like', '%all%')
                ->orWhere('device', 'like', '%*%');
        });

    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeIsBanner($query)
    {
        return $query->where('is_banner', 1);
    }

    public function scopeIsHome($query)
    {
        $activeCategories = Category::active()->isHome()->get();

        foreach ($activeCategories as $cate) {

            $limitCate = Str::limit($cate->name, 3, '');
            $query->orWhere('category', 'like', "%" . $limitCate . "%");
        }

        return $query;
    }
}
