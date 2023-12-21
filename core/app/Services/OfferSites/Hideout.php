<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class Hideout
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(38);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('sub1'),
            'amount' => request('rate'),
            'trx' => md5(request('tid')),
            'offer_name' => request('offer_name'),
        ];

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }

}
