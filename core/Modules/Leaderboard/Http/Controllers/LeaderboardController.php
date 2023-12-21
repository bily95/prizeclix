<?php

namespace Modules\Leaderboard\Http\Controllers;

use App\Models\CronJob;
use App\Models\Transaction;
use App\Models\OfferLog;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Leaderboard\Entities\Leaderboard;
use Modules\Leaderboard\Entities\LeaderboardLog;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard.
     *
     * @param string $type
     * @return Renderable
     */
    public function index($type = 'daily')
    {
        abort_if(!in_array($type, ['daily', 'monthly']), 404);

        $users = $type === 'daily' ? $this->getUsersDaily() : $this->getUsersMonthly();

        $userPoints = $this->getAuthUserPoints($type);

        $levels = Leaderboard::where('type', $type)
            ->orderByDesc('reward')
            ->get();

        $topUsers = $users->take($levels->count());

        return view('leaderboard::user.index', compact('users', 'levels', 'userPoints', 'type', 'topUsers'));
    }

    /**
     * Get users for the daily leaderboard.
     */
    protected function getUsersDaily()
    {
        return OfferLog::with('users:id,username')
            ->where('created_at', '>=', today()->subDay())
            ->selectRaw('user_id, SUM(amount) as total_earning')
            ->groupBy('user_id')
            ->orderByDesc('total_earning')
            ->limit(15)
            ->get();
    }

    /**
     * Get users for the monthly leaderboard.
     */
    protected function getUsersMonthly()
    {
        return OfferLog::with('users:id,username')
            ->where('created_at', '>=', today()->subMonth())
            ->selectRaw('user_id, SUM(amount) as total_earning')
            ->groupBy('user_id')
            ->orderByDesc('total_earning')
            ->limit(15)
            ->get();
    }

    public function getAuthUserPoints($type = 'daily')
    {
        return $type == 'daily' ? OfferLog::where('user_id', auth()->id())
            ->where('created_at', '>=', today()->subDay())
            ->sum('amount')
            : OfferLog::where('user_id', auth()->id())
            ->where('created_at', '>=', today()->subMonth())
            ->sum('amount');
    }

    /**
     * Perform cron job to pay users based on leaderboard type.
     *
     * @param string $type The leaderboard type ('daily' or 'monthly')
     * @return string
     */
    public function cronjob($type = 'daily')
    {
        $status = 1;

        try {

            // Validate leaderboard type
            abort_if(!in_array($type, ['daily', 'monthly']), 404);

            // Get users based on leaderboard type
            $users = $type === 'daily' ? $this->getUsersDaily() : $this->getUsersMonthly();

            // Get leaderboard levels for the given type
            $levels = Leaderboard::where('type', $type)
                ->orderByDesc('reward')
                ->get();

            // Get the top users based on the number of levels
            $topUsers = $users->take($levels->count());

            // Process payouts for each level and user
            foreach ($levels as $index => $level) {
                if (isset($topUsers[$index])) {
                    $user = $topUsers[$index];

                    // Increment user's balance and create a leaderboard log
                    $user->increment('balance', $level->reward);
                    $leaderLog = LeaderboardLog::create([
                        'user_id' => $user->id,
                        'reward' => $level->reward,
                        'type' => $type,
                    ]);

                    //save transactions
                    Transaction::store([
                        'user' => $user,
                        'amount' => getAmount($level->reward),
                        'from' => 'LEADERBOARD',
                        'source_id' => $leaderLog->id,
                        'details' => 'Leaderboard Earnings',
                    ]);
                }
            }
        } catch (\Exception $e) {
            $status = 0;
        }

        CronJob::create([
            'url' => url('leaderboard/cron/'  . $type),
            'status' => $status,
        ]);

        return 'Cronjob completed!';
    }


    public function history($type = 'daily')
    {
        abort_if(!in_array($type, ['daily', 'monthly']), 404);

        return view('leaderboard::user.history', [
            'logs' => LeaderboardLog::where('type', $type)
                ->paginate(),
            'type' => $type
        ]);
    }
}
