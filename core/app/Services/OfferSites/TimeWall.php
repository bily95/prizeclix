<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class TimeWall
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(15);
    }

    public function verify()
    {
        if(!in_array(getUserIP(), ['173.44.49.203'])){
            return 'Invalid Request';
        }

        $marcos = [
            'user_id' =>  request('userID'),
            'amount' => request('currencyAmount'),
            'trx' => md5(request('transactionId')),
            'offer_name' => 'Timewall',
        ];

        if (request('status') == 2) {
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        }

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }
}
