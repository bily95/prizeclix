<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class CPXResearch
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(10);
    }

    public function verify()
    {

        if(!in_array(getUserIP(), ['188.40.3.73','2a01:4f8:d0a:30ff::2','157.90.97.92'])){
            return 'Invalid Request';
        }

        $marcos = [
            'user_id' =>  request('user_id'),
            'amount' => request('amount_local'),
            'trx' => md5(request('hash')),
            'offer_name' => 'CPX Research',
            'offer_id' => request('offer_id'),
        ];

        if(request('status') == 2){
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        }

        return request('status') == 1 && Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }

}
