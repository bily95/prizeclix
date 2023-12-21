<?php

namespace Modules\OffersNetwork\Http\Services\Providers;

use App\Models\OfferSetup;
use Illuminate\Support\Str;
use Modules\OffersNetwork\Entities\OffersStorage;
use Modules\OffersNetwork\Http\Services\FetchOffersService;

class Notik extends FetchOffersService
{
    public  static function get()
    {

        $provider = OfferSetup::findOrFail(14);

        if ($provider->is_active == false || $provider->en_api == false) {
            return [];
        }

        $url = 'https://notik.me/api/v2/get-offers/all?';

        $params = [
            'api_key' => $provider->offer_keys->api_key,
            'pub_id' => $provider->offer_keys->publish_id,
            'app_id' => $provider->offer_keys->app_id,
        ];

        return self::fetchAndStoreAllPages($url . http_build_query($params), $provider);
    }

    public  static function storeOffers($offers, $provider)
    {
        foreach ($offers['data'] as $offer) {

            if (OffersStorage::where('provider_id', $provider->id)
                ->where('uid', $offer['offer_id'])->exists() === false
            ) {
                OffersStorage::create(
                    [
                        'provider_id' => $provider->id,
                        'uid' => $offer['offer_id'],
                        'name' => $offer['name'],
                        'description' => $offer['description1'] . "<br />" . $offer['description2'],
                        'image' => $offer['image_url'],
                        'rewards' => $offer['payout'] * config('settings.offers_conversion_rate', 1),
                        'payout' => $offer['payout'],
                        'click_url' => Str::replace('[user_id]', '{user}', $offer['click_url']),
                        'category' => strtolower(implode('-', $offer['categories'])),
                        'country' => implode('-', $offer['country_code']),
                        'device' => self::mapDevices($offer['os']),
                    ]
                );
            }
        }
    }

    protected static function fetchAndStoreAllPages($url, $provider)
    {
        set_time_limit(60*24);
        try {
            while ($url) {
                $response = self::curlGet($url);

                if ($response['statusCode'] !== 200 || !isset($response['data']['offers'])) {
                    break;
                }
                self::storeOffers($response['data']['offers'], $provider);

                if (isset($response['data']['offers']['has_more_pages']) && $response['data']['offers']['has_more_pages'] === true) {
                    $url = $response['data']['offers']['next_page_url'];
                } else {
                    $url = null;
                }
            }
        } catch (\Exception $e) {
            logger($e->getMessage());
        }

        return 'done';
    }
}
