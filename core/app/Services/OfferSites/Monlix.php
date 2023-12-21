<?php


namespace App\Services\OfferSites;


use App\Services\Postback;
use App\Models\OfferSetup;


class Monlix
{
    protected $offer;

    public function __construct()
    {   
        $this->offer = OfferSetup::findOrFail(13);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('userid'),
            'amount' => request('reward'),
            'trx' => md5(request('transactionid')),
            'offer_name' => request('taskName'),
            'offer_id' => request('offer_id'),
        ];

        if(request('status') == 2){
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        }

        return request('status') == 1 && Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }

}
