<?php

namespace Modules\OffersNetwork\Http\Controllers\Api;

use App\Models\CronJob;
use Illuminate\Routing\Controller;
use Modules\OffersNetwork\Http\Services\Providers\CPXResearch;
use Modules\OffersNetwork\Http\Services\Providers\Kiwiwall;
use Modules\OffersNetwork\Http\Services\Providers\Monlix;
use Modules\OffersNetwork\Http\Services\Providers\Notik;
use Modules\OffersNetwork\Http\Services\Providers\Wannads;

class FetchProviderController extends Controller
{

    public function index($provider = 'notik')
    {
        if ($provider == 'notik') {
            $status = 1;
            try {
                return Notik::get();
            } catch (\Throwable $th) {
                $status = 0;
                CronJob::create([
                    'url' => route('offers-network.fetch.provider', $provider),
                    'status' => $status,
                ]);
            }
        }

        return 'done';
    }

    public function fetch($provider)
    {
        abort_if(!in_array($provider, ['wannads', 'cpx-research', 'monlix', 'kiwiwall']), 404);

        switch ($provider) {
            case 'wannads':
                return Wannads::get();
                break;
            case 'cpx-research':
                return CPXResearch::get();
                break;

            case 'monlix':
                return Monlix::get();
                break;

            case 'kiwiwall':
                return Kiwiwall::get();
                break;
        }
    }
}
