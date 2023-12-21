<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class Wannads
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(4);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('subId'),
            'amount' => request('reward'),
            'trx' => md5(request('signature')),
            'offer_name' => request('offer_name'),
            'offer_id' => request('offer_id'),
        ];

        if (request('status') == 2) {
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        }
        

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;

    }

}
