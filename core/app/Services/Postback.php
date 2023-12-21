<?php

namespace App\Services;

use App\Models\User;
use App\Models\OfferLog;
use Illuminate\Support\Facades\DB;
use Modules\OffersNetwork\Entities\OffersTrack;

class Postback
{
    /**
     * Mapping of endpoint strings to offer site classes.
     *
     * @var array
     */
    protected $offerSites = [
        '8ckhgtg5pd5lil' => OfferSites\Wannads::class,
        'dk6ehsjp0i51cg' => OfferSites\OfferToro::class,
        '8ds9w427ilpeeg' => OfferSites\KiwiWall::class,
        '0wc3nygljr35o1' => OfferSites\CPXResearch::class,
        'ek6mu26drorper' => OfferSites\AdgateMedia::class,
        'ww39ps1m8smavt' => OfferSites\Monlix::class,
        'ujtei8bb5ef0yu' => OfferSites\Notik::class,
        '6zdv0so44213zq' => OfferSites\TimeWall::class,
        'al867jxx8nehya' => OfferSites\Revlum::class,
        '9o74qhltf19hxh' => OfferSites\Inbrain::class,
        '8a8t9zenlnjxq9' => OfferSites\Bitlabs::class,
        '9lnfge4fejruah' => OfferSites\AdscendMedia::class,
        'c8q7d60nkaxsf3' => OfferSites\Hideout::class,
        'dvqf5hvms5gsa7' => OfferSites\TheoremReach::class,
        '9cg6mbweddh5fh' => OfferSites\AyetStudio::class,
        '2mprlafenw6ky7' => OfferSites\myChips::class,
        'fc9lydslxjm287' => OfferSites\MMWall::class,

    ];

    /**
     * Verify the postback endpoint and handle verification.
     *
     * @param  string  $endpoint
     * @return mixed
     */
    public function verify($endpoint = '')
    {
        DB::table('request_logs')->insert([
            'source' => 'Offer: ' . $endpoint,
            'body' => json_encode(request()->all()),
            'ip_address' => getUserIP(),
        ]);

        if (isset($this->offerSites[$endpoint])) {
            $offerSite = app($this->offerSites[$endpoint]);
            return $offerSite->verify();
        }

        return 'Error: Invalid postback URL';
    }

    /**
     * Check if a transaction with the given transaction ID exists.
     *
     * @param  string  $trx
     * @return bool
     */
    public static function checkTrans($trx)
    {
        return OfferLog::where('trx', $trx)->exists();
    }

    /**
     * Reward a user with the specified amount.
     *
     * @param  int  $userId
     * @param  float  $amount
     * @return bool
     */
    public static function rewardUser($marcos, $offer)
    {

        $user = User::find($marcos['user_id']);

        if (!$user) return false;

        $marcos['source_id'] = $offer->id;

        if (self::checkTrans($marcos['trx'])) return false;

        if ($offer->is_auto_pay) {
            $user->increment('balance', $marcos['amount']);
            self::storeTransaction($user, $marcos);
            rewardReferral($user->id, $marcos['amount'], 'win');
        }

        self::storeOfferLog($user, $marcos, $offer);

        return true;
    }

    public  static function chargeBack($marcos)
    {
        $offer = OfferLog::where('trx', $marcos['trx'])->first();
        if ($offer && $offer->is_paid) {
            $offer->users->decrement('balance', $marcos['amount']);
            self::storeTransaction($offer->users, $marcos, '-');
            $offer->update(['status' => 2]);
        }
        return true;
    }

    public  static function storeTransaction($user, $marcos, $type = '+')
    {
        //save transactions
        \App\Models\Transaction::store([
            'user' => $user,
            'amount' => $marcos['amount'],
            'from' => $type == '+' ? 'OFFER_REWARD' : 'OFFER_RECHARGE',
            'source_id' => $marcos['offer_id'],
            'details' => $type == '+' ? 'Offer Earnings' : 'Offer Recharge',
        ], 0, $type);
    }

    public  static function storeOfferLog($user, $marcos, $offer)
    {
        OfferLog::create([
            'offer_id' => $offer->id,
            'user_id' => $user->id,
            'offer_name' => $marcos['offer_name'],
            'trx' => $marcos['trx'],
            'amount' => $marcos['amount'],
            'is_paid' => $offer->is_auto_pay ? 1 : 0,
            'status' => $offer->is_auto_pay ? 1 : 0,
        ]);

        if (isset($marcos['offer_id'])) {
            $offer = OffersTrack::where('user_id', $user->id)
                ->where('offer_id', $marcos['offer_id'])
                ->update(['is_completed' => true]);
        }
    }
}
