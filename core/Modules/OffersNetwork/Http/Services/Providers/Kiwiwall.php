<?php

namespace Modules\OffersNetwork\Http\Services\Providers;

use App\Models\OfferSetup;
use Modules\OffersNetwork\Entities\OffersStorage;
use Modules\OffersNetwork\Http\Services\FetchOffersService;

class Kiwiwall extends FetchOffersService
{
    public  static function get()
    {

        if (self::cacheGet('Kiwiwall_offers') !== false)
            return self::cacheGet('Kiwiwall_offers');

        $provider = OfferSetup::findOrFail(11);

        if ($provider->is_active == false || $provider->en_api == false) {
            self::cacheSet('Kiwiwall_offers', 'fetched');
            return [];
        }

        $url = 'https://www.kiwiwall.com/get-offers/' . $provider->offer_keys->api_key . '?';

        $params = [
            'country' => is_local() ? 'EG' : getIpInfo()['code'],
            's' => '{user}'
        ];


        $response = self::curlGet($url . http_build_query($params));

        if ($response['statusCode'] === 200 && isset($response['data'])) {
            self::storeOffers($response['data'], $provider);
        }
        self::cacheSet('Kiwiwall_offers', 'fetched');
        return 'done';
    }

    public  static function storeOffers($offers, $provider)
    {

        foreach ($offers['offers'] as $offer) {

            OffersStorage::updateOrCreate(
                [
                    'provider_id' => $provider->id,
                    'uid' => $offer['id'],
                ],
                [
                    'name' => $offer['name'],
                    'description' => $offer['instructions'],
                    'image' => $offer['logo'],
                    'rewards' => $offer['cr'] * GENERAL_SETTING['cur_rate'],
                    'payout' => $offer['cr'],
                    'click_url' => $offer['link'],
                    'category' => strtolower($offer['category']),
                    'country' => $offers['country'],
                    'device' => self::mapDevices(['ALL']),
                ]
            );
        }

    }
}
