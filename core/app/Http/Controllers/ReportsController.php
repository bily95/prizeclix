<?php

namespace App\Http\Controllers;


use App\Models\OfferLog;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Modules\DailyTasks\Entities\DailyTaskLog;
use Modules\Leaderboard\Entities\LeaderboardLog;

class ReportsController extends Controller
{

    public function userOfferReports()
    {

        if (request()->input('fetchOffers')) {
            $offers = OfferLog::with('offers:id,name')
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();

            $offers = collect($offers)->map(function ($item) {
                $item['created_at'] = diffForHumans($item['created_at']);
                $item['status'] = bolToText($item['status'], true, 'Pending', 'Paid', 'Recharged');
                return $item;
            });

            return response()->json(['data' => $offers]);
        }

        if (request()->input('fetchLeader') && Route::has('user.leaderboard')) {
            $leaders = LeaderboardLog::where('user_id', auth()->id())
                ->orderBy('updated_at', 'desc')
                ->get();

            $leaders = collect($leaders)->map(function ($item) {
                $item['reward'] = showAmount($item['reward'], 0) . GENERAL_SETTING['cur_sym'];
                $item['type'] = ucfirst($item['type']) . ' Rewards';
                $item['created_at'] = diffForHumans($item['created_at']);
                return $item;
            });

            return response()->json(['data' => $leaders]);
        }

        if (request()->input('fetchDailyBox') && Route::has('dailytasks')) {
            $claims = DailyTaskLog::with('task:id,title')
                ->where('user_id', auth()->id())
                ->orderBy('updated_at', 'desc')
                ->get();

            $claims = collect($claims)->map(function ($item) {
                $item['task']['title'] = Str::limit($item['task']['title'], 15);
                $item['reward'] = showAmount($item['reward'], 0) . GENERAL_SETTING['cur_sym'];
                $item['created_at'] = diffForHumans($item['created_at']);
                return $item;
            });

            return response()->json(['data' => $claims]);
        }

        $totalEarnings = Transaction::where('trx_type', '+')
            ->where('user_id', auth()->id())
            ->sum('amount');
        $holdingBalance = OfferLog::where('user_id', auth()->id())
            ->where('is_paid', 0)
            ->sum('amount');

        return view(SETTING['site_theme'] . 'offers.reports', [
            'totalEarnings' => $totalEarnings,
            'holdingBalance' => $holdingBalance,
        ]);
    }
}
