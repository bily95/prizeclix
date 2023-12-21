<?php

namespace App\Http\Controllers\Admin;

use App\Models\CronJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageSiteController extends Controller
{
    public function cron(Request $request)
    {

        $crons = [
            "Notik fetch offers API" => route('offers-network.fetch.provider', 'notik'),
            "leaderboard daily" => url('leaderboard/cron/daily'),
            "leaderboard monthly" => url('leaderboard/cron/monthly'),
            "User Level up" => route('site.upUserLevel'),
        ];


       $cronjobs = CronJob::where('url', 'like', "%" . $request->url ."%")
        ->paginate();

        return view(
            'admin.manage-site.cron',
            compact('cronjobs', 'crons'),
        );
    }
}
 