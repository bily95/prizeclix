<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class KiwiWall
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(11);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('sub_id'),
            'amount' => request('amount'),
            'trx' => md5(request('signature')),
            'offer_name' => request('offer_name'),
            'offer_id' => request('offer_id'),
        ];

        if(request('status') == 2){
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos);
        }

        return Postback::rewardUser($marcos, $this->offer) ? 'ok' : 0;

    }

}
