<?php


namespace App\Services\OfferSites;


use App\Services\Postback;
use App\Models\OfferSetup;


class myChips
{
    protected $offer;

    public function __construct()
    {   
        $this->offer = OfferSetup::findOrFail(63);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('user_id'),
            'amount' => request('user_payout_in_currency'),
            'trx' => md5(request('cid')),
            'offer_name' => request('offer_name'),
        ];

        if(request('status') == 2){
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos);
        }
        
        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }

}
