<?php

namespace Modules\OffersNetwork\Http\Services\Providers;

use App\Models\OfferSetup;
use Modules\OffersNetwork\Entities\OffersStorage;
use Modules\OffersNetwork\Http\Services\FetchOffersService;

class CPXResearch extends FetchOffersService
{
    public  static function get()
    {

        if(self::cacheGet('CPXResearch_offers') !== false)
            return self::cacheGet('CPXResearch_offers');

        $provider = OfferSetup::findOrFail(10);

        if ($provider->is_active == false || $provider->en_api == false) {
            self::cacheSet('CPXResearch_offers', 'fetched');
            return [];
        }

        $url = 'https://live-api.cpx-research.com/api/get-surveys.php?';

        $params = [
            'app_id' => $provider->offer_keys->app_id,
            'ext_user_id' => '{user}',
            'output_method' => 'api',
            'ip_user' => is_local() == false ? getUserIP() : '156.221.24.105',
            'user_agent' => rawurlencode($_SERVER['HTTP_USER_AGENT']),
        ];

        $response = self::curlGet($url . http_build_query($params));

        if ($response['statusCode'] === 200 && isset($response['data']['surveys'])) {
            self::storeOffers($response['data']['surveys'], $provider);
        }
        self::cacheSet('CPXResearch_offers', 'fetched');
        return 'done';
    }

    public  static function storeOffers($offers, $provider)
    {
        $userCountry = is_local() ? 'EG' : getIpInfo()['code'];

        foreach ($offers as $offer) {

            OffersStorage::updateOrCreate(
                [
                    'provider_id' => $provider->id,
                    'uid' => $offer['id'],
                ],
                [
                    'name' => 'Online Surveys',
                    'description' => 'Complete the survey to get paid',
                    'image' => asset('/asset/static/app/imgs/loading.gif'),
                    'rewards' => $offer['payout_publisher_usd'] * GENERAL_SETTING['cur_rate'],
                    'payout' => $offer['payout_publisher_usd'],
                    'click_url' => $offer['href_new'],
                    'category' => 'survey',
                    'country' => $userCountry,
                    'device' => self::mapDevices(['all']),
                ]
            );
        }


    }
}
