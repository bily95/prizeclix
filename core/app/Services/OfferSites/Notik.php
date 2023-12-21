<?php


namespace App\Services\OfferSites;


use App\Services\Postback;
use App\Models\OfferSetup;


class Notik
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(14);
    }

    public function verify()
    {

        // check request IP;
        if (!in_array(getUserIP(), ['139.177.199.93']))
            return 'Invalid Request';

        // define marcos
        $marcos = [
            'user_id' =>  request('user_id'),
            'amount' => intval(request('amount')),
            'trx' => md5(request('txn_id')),
            'offer_name' => request('offer_name'),
            'offer_id' => request('offer_id'),
        ];

        // charge back 
        if ($marcos['amount'] < 0) {
            $marcos['amount'] = abs($marcos['amount']);
            $marcos['trx'] = request('rewarded_txn_id');
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 1;
        }

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 1;
    }
}
