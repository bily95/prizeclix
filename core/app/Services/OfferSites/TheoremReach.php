<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;


class TheoremReach
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(61);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('user_id'),
            'amount' => request('reward'),
            'trx' => md5(request('tx_id')),
            'offer_name' => request('offer_name'),
        ];

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;

    }
}
