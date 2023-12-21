<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferLog;
use App\Models\User;
use App\Models\OfferSetup;

class MMWall
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(64);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('user_id'),
            'amount' => request('amount'),
            'trx' => md5(request('transaction_id')),
            'offer_name' => request('offer_name'),
        ];

        if (request('status') == 2) {
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        }

        return Postback::rewardUser($marcos, $this->offer) ? 'ok' : 0;
    }
}
