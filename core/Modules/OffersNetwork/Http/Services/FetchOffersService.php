<?php

namespace Modules\OffersNetwork\Http\Services;

use Illuminate\Support\Str;
use Modules\OffersNetwork\Entities\Category;

class FetchOffersService
{
    public static function curlGet(string $url, int $timeout = 3, int $maxRetries = 1): ?array
    {

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];

        $retryCount = 0;
        do {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_FAILONERROR => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);

            $result = curl_exec($ch);
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus === 200 && $result !== false) {
                try {
                    return [
                        'statusCode' => $httpStatus,
                        'data' => json_decode($result, true),
                    ];
                } catch (\Exception $e) {
                    logger($e->getMessage());
                    return [
                        'statusCode' => 404,
                        'data' => [],
                    ];
                }
            } else {
                // Log the cURL error
                logger(curl_error($ch));

                // Retry if within maxRetries limit
                $retryCount++;
            }
        } while ($retryCount <= $maxRetries);

        logger('Curl Error after retry: ' . $maxRetries);
        return [
            'statusCode' => 404,
            'data' => [],
        ];
    }

    public  static function mapDevices($devices)
    {
        $defaultDevices = ['windows', 'android', 'ipad', 'iphone','mac'];

        $finalDevices = [];

        foreach ($devices as $device) {
            if (Str::contains(json_encode($defaultDevices), Str::limit($device,3,''))) {
                $finalDevices[] = $device;
            }
        }

        if(count($finalDevices) == 0){
            $finalDevices = $defaultDevices;
        }

        return strtolower(implode('-',$finalDevices));
    }

    public static function cacheGet($key)
    {
        $cacheKey = $key .'_'. getUserIp();

        $offers = cache()->get($cacheKey);

        if($offers === 'fetched') 
            return $offers;

        return false;
    }

    public static function cacheSet($key, $value)
    {
        $cacheKey = $key .'_'. getUserIp();

        $offers = cache()->get($cacheKey);

        if($offers == 'fetched') 
            return $offers;

        cache()->set($key, $value, 5);
    }
}
