<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferLog;
use App\Models\OfferSetup;
use App\Models\User;

class AdscendMedia
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(58);
    }

    public function verify()
    {

        if (!in_array(getUserIP(), ['52.117.122.183', '52.117.127.192', '52.117.121.196']))
            return 'Invalid Request';

        $marcos = [
            'user_id' =>  request('sub1'),
            'amount' => request('rate'),
            'trx' => md5(request('tid')),
            'offer_name' => request('offer_name'),
        ];

        // charge back 
        if ($marcos['amount'] < 0) {
            $marcos['amount'] = abs($marcos['amount']);
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        }

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }
}
