<?php

namespace Modules\DailyTasks\Http\Controllers;

use App\Models\OfferLog;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\DailyTasks\Entities\DailyTask;
use Modules\DailyTasks\Entities\DailyTaskLog;

class DailyTasksController extends Controller
{
    /**
     * Display the daily tasks and user information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = DailyTask::all();
        $userOffers = $this->getUserOffer('offersCount');
        $userEarnings = $this->getUserOffer('totalEarnings');
        $userClaimedOffers = $this->getUserClaim();
        $userClaimedEarn = $this->getUserClaim('earn');

        return response()->json([
            'view' => view('dailytasks::index', compact(
                'tasks',
                'userOffers',
                'userEarnings',
                'userClaimedOffers',
                'userClaimedEarn'
            ))->render(),
        ]);
    }

    /**
     * Claim a specific daily task reward.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function claim($id)
    {
        $task = DailyTask::findOrFail($id);
        $user = [
            'userOffers' => $this->getUserOffer('offersCount'),
            'userEarnings' => $this->getUserOffer('totalEarnings'),
            'userClaims' => $this->getUserClaim(),
            'userClaimedEarn' => $this->getUserClaim('earn')
        ];

        if ($task->type == 'earn') {
            if (($user['userEarnings'] >= $task->require)
                && ($user['userClaimedEarn'] < $task->reward)
            ) {
                $this->rewardUser($task);
            }
        } else {
            if (($user['userOffers'] >= $task->condition)
                && ($user['userClaims'] < $task->reward)
                && ($user['userEarnings'] >= $task->require)
            ) {
                $this->rewardUser($task);
            }
        }

        return back()->withNotify([['success', 'You claimed ' . $task->reward]]);
    }

    /**
     * Get user offer information based on the specified info type.
     *
     * @param  string  $info
     * @return int|float
     */
    public function getUserOffer($info)
    {
        $getInfo = OfferLog::where('user_id', Auth::id())
            ->where('created_at', '>=', today()->subDay())
            ->where('is_paid', 1);

        if ($info == 'offersCount') {
            return $getInfo->count();
        }

        if ($info == 'totalEarnings') {
            return $getInfo->sum('amount');
        }

        return 0;
    }

    /**
     * Get the total reward amount claimed by the user.
     *
     * @return int|float
     */
    public function getUserClaim($type = 'offer')
    {
        return DailyTaskLog::where('user_id', Auth::id())
            ->where('type', $type)
            ->where('created_at', '>=', today()->subDay())
            ->sum('reward');
    }

    /**
     * Reward the user for completing a task.
     *
     * @param  \Modules\DailyTasks\Entities\DailyTask  $task
     * @return void
     */
    public function rewardUser(DailyTask $task)
    {
        $user = Auth::user();

        $user->balance += $task->reward;
        $user->save();

        $log = DailyTaskLog::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'reward' => $task->reward,
            'type' => $task->type,
        ]);

        //save transactions
        Transaction::store([
            'user' => $user,
            'amount' => getAmount($task->reward),
            'from' => 'DAILY_TASKS',
            'source_id' => $log->id,
            'details' => 'Daily tasks claim'
        ]);
    }
}
