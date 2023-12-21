<?php

namespace Modules\OffersNetwork\Http\Services\Providers;

use App\Models\OfferSetup;
use Modules\OffersNetwork\Entities\OffersStorage;
use Modules\OffersNetwork\Http\Services\FetchOffersService;

class Wannads extends FetchOffersService
{
    public  static function get()
    {
        if (self::cacheGet('Wannads_offers') !== false)
            return self::cacheGet('Wannads_offers');

        $provider = OfferSetup::findOrFail(4);

        if ($provider->is_active == false || $provider->en_api == false) {
            self::cacheSet('Wannads_offers', 'fetched');
            return [];
        }

        $url = 'http://api.wannads.com/v2/offers?';

        $params = [
            'api_key' => $provider->offer_keys->api_key,
            'api_secret' => $provider->offer_keys->api_secret,
            'device' => getDeviceType(),
            'country' => is_local() == false ? getIpInfo()['code'] : 'US',
            'ip' => is_local() == false ? getUserIp() : '156.221.37.228',
            'sub_id' => '{user}',
        ];


        $response = self::curlGet($url . http_build_query($params));

        if ($response['statusCode'] === 200 && isset($response['data'])) {
            self::storeOffers($response['data'], $provider);
        }

        self::cacheSet('Wannads_offers', 'fetched');
        return 'done';
    }

    public  static function storeOffers($offers, $provider)
    {

        foreach ($offers as $offer) {

            OffersStorage::updateOrCreate(
                [
                    'provider_id' => $provider->id,
                    'uid' => $offer['id'],
                ],
                [
                    'name' => $offer['conversion_point'],
                    'description' => $offer['description'],
                    'image' => $offer['img_url'],
                    'rewards' => $offer['revenue'] * GENERAL_SETTING['cur_rate'],
                    'payout' => $offer['revenue'],
                    'click_url' => $offer['offer_url'],
                    'category' => strtolower(implode('-',$offer['categories'])),
                    'country' => $offer['country'],
                    'device' => self::mapDevices($offer['devices']),
                ]
            );
        }

    }
}
