<?php

namespace Modules\OffersNetwork\Http\Services\Providers;

use App\Models\OfferSetup;
use Illuminate\Support\Str;
use Modules\OffersNetwork\Entities\OffersStorage;
use Modules\OffersNetwork\Http\Services\FetchOffersService;

class Monlix extends FetchOffersService
{
    public  static function get()
    {
        if (self::cacheGet('Monlix_offers') !== false)
            return self::cacheGet('Monlix_offers');

        $provider = OfferSetup::findOrFail(13);

        if ($provider->is_active == false || $provider->en_api == false) {
            self::cacheSet('Monlix_offers', 'fetched');
            return [];
        }

        $url = 'https://api.monlix.com/api/campaigns/?';

        $params = [
            'appid' => $provider->offer_keys->api_key,
            'userid' => '{user}',
            'userip' => is_local() == false ? getUserIp() : '156.221.24.105',
            'ua' => rawurlencode($_SERVER['HTTP_USER_AGENT']),
        ];

        $response = self::curlGet($url .  http_build_query($params));

        if ($response['statusCode'] === 200 && is_array($response['data'])) {
            self::storeOffers($response['data'], $provider);
        }

        self::cacheSet('Monlix_offers', 'fetched');
        return 'done';
    }

    public  static function storeOffers($offers, $provider)
    {


        foreach ($offers as $offer) {

            $userCountry = is_local() ? 'EG' : getIpInfo()['code'];

            OffersStorage::updateOrCreate(
                [
                    'provider_id' => $provider->id,
                    'uid' => $offer['id'],
                ],
                [
                    'name' => $offer['name'],
                    'description' => $offer['description'],
                    'image' => $offer['image'],
                    'rewards' => $offer['payout'] * GENERAL_SETTING['cur_rate'],
                    'payout' => $offer['payout'],
                    'click_url' =>$offer['url'],
                    'category' => strtolower(implode('-',$offer['categories'])),
                    'country' => $userCountry,
                    'device' => self::mapDevices($offer['oss']),
                ]
            );
        }
    }
}
