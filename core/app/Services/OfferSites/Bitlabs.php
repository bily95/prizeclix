<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferLog;
use App\Models\User;
use App\Models\OfferSetup;

use Illuminate\Support\Facades\Log;

class Bitlabs
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(56);
    }

    public function verify()
    {

        $marcos = [
            'user_id' =>  request('uid'),
            'amount' => request('val'),
            'trx' => md5(request('trx')),
            'offer_name' => request('offer_name'),
        ];

        if (request('type') == 'RECONCILIATION') {
            $marcos['source_id'] = $this->offer->id;
            return Postback::chargeBack($marcos) ? 1 : 0;
        }

        return in_array(request('type'), ['COMPLETE', 'START_BONUS', 'SCREENOUT'])
            && Postback::rewardUser($marcos, $this->offer) ? 1 : 0;
    }
}
