<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OfferLog;
use App\Models\OfferSetup;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{


    public function postBack(Request $request, $endPoint)
    {

        $offer = OfferSetup::where('endpoint', $endPoint)->first();
        if(!$offer) return 0;

        $keys = $offer->keys;

        if ($keys->server_ip) {
            if (Str::contains($keys->server_ip, getUserIP()) != true)
                return $keys->response;
        }
        
        
        // define required parameters
        $amount = $request->query(Str::before($keys->amount, '='), 0);
        $userId = $request->query(Str::before($keys->user_ident, '='), 0);
        $trx = $request->query(Str::before($keys->trx, '='), md5(rand(111,999))) ;

       
        if (OfferLog::where('trx', $trx)->exists())
            return 'Error: That is second transition!';

        $offerLog = OfferLog::create([
            'offer_id' => $offer->id,
            'user_id' => $userId,
            'trx' => $trx,
            'amount' => $amount,
            'is_paid' => $offer->is_auto_pay ? 1 : 0,
            'status' => $offer->is_auto_pay ? 1 : 0,
        ]);

        if ($offer->is_auto_pay) {
            $this->rewardUser(
                $userId,
                $amount,
                $offerLog
            );
        }


        return $keys->response;
    }

    public function rewardUser($userId, $amount, $offerLog)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $user->increment('balance', $amount);
        self::storeTransaction($user, $amount);
        $offerLog->update(['status' => 1]);
    }

    public function reverseRewardUser($userId, $amount, $offerLog)
    {
        $user = User::where('id', $userId)->firstOrFail();
        $user->decrement('balance', $amount);
        self::storeTransaction($user, $offerLog, '-');

        $offerLog->update(['status' => 2]);
    }

    public  static function storeTransaction($user, $offer, $type = '+')
    {
        //save transactions
        \App\Models\Transaction::store([
            'user' => $user,
            'amount' => $offer->amount,
            'from' => $type == '+' ? 'OFFER_REWARD' : 'OFFER_RECHARGE',
            'source_id' => $offer->offer_id,
            'details'=> $type == '+' ? 'Offer Earnings' : 'Offer Recharge' ,
        ], 0, $type == '+' ? 'Offer Rewarded' : 'Offer Charge back');
    }
}
