<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class Revlum
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(29);
    }

    public function verify()
    {

        if(!in_array(getUserIP(), ['209.159.156.198'])){
            return "invalid Request";
        }

        $marcos = [
            'user_id' =>  request('subId'),
            'amount' => request('reward'),
            'trx' => md5(request('transId')),
            'offer_name' => request('offerName'),
        ];

        if(request('status') == 2){
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        } 

        return  request('status') == 1 && Postback::rewardUser($marcos, $this->offer) ? 1 : 0;

    }

}
