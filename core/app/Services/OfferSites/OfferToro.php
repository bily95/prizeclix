<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

class OfferToro
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(6);
    }

    public function verify()
    {
        if(!in_array(getUserIP(), ['54.175.173.245'])){
            return 'Invalid Request';
        }

        $marcos = [
            'user_id' =>  request('user_id'),
            'amount' => request('amount'),
            'trx' => md5(request('sig')),
            'offer_name' => request('o_name'),
        ];

        // charge back 
        if($marcos['amount'] < 0){
            $marcos['amount'] = abs($marcos['amount']);
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 1;
        }

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }

}
