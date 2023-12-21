<?php


namespace App\Services\OfferSites;

use App\Models\OfferLog;
use App\Models\OfferSetup;
use App\Models\User;
use App\Services\Postback;
use Illuminate\Support\Str;

class AyetStudio
{
    protected $offer;

    public function __construct()
    {   
        $this->offer = OfferSetup::findOrFail(62);
    }

    public function verify()
    {

        if(!in_array(getUserIP(), ['35.165.166.40','35.166.159.131', '52.40.3.140']))
            return 'Invalid Request';

        $marcos = [
            'user_id' =>  request('external_identifier'),
            'amount' => request('currency_amount'),
            'trx' => md5(request('transaction_id')),
            'offer_name' => request('offer_name'),
        ];

        if(request('is_chargeback') == 1){
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos);
        }

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }

}
