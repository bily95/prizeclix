<?php


namespace App\Services\OfferSites;

use App\Services\Postback;
use App\Models\OfferSetup;

use Illuminate\Http\Request;

class AdgateMedia
{
    protected $offer;

    public function __construct()
    {
        $this->offer = OfferSetup::findOrFail(7);
    }

    public function verify(Request $request)
    {

        $marcos = [
            'user_id' =>  $request->input('user_id'),
            'amount' => $request->input('point_value'),
            'trx' => md5($request->input('transaction_id')),
            'offer_name' => $request->input('offer_name'),
        ];

        return Postback::rewardUser($marcos, $this->offer) ? 1 : 0;

    }
}
