<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class Inbrain
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(31);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('PanelistId'),
            'amount' => request('RevenueAmount'),
            'trx' => md5(request('RewardId')),
            'offer_name' => request('offer_name'),
        ];

        if (request('RewardType') == 'survey_disqualified') {
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos);
        }

        return in_array(request('RewardType'), ['survey_completed', 'ad_hoc', 'rank_reached', 'profiler_completed'])
            && Postback::rewardUser($marcos, $this->offer) ? 'ok' : 0;
    }
}
