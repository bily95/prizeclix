<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Referral;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\CommissionLog;
use App\Models\GeneralSetting;
use App\Models\WithdrawMethod;
use App\Rules\FileTypeValidate;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class UserController extends Controller
{

 
    public function deleteAccount()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Wrap database operations in a transaction for data consistency
        DB::transaction(function () use ($user) {
            // Delete related data using Eloquent relationships and cascading deletes

            // Delete user profile
            $user->profile()->delete();

            // Delete user login logs
            $user->login_logs()->delete();

            // Delete user transactions
            $user->transactions()->delete();

            // Delete user withdrawals
            $user->withdrawals()->delete();

            // Update support tickets associated with the user
            \App\Models\SupportTicket::where('user_id', $user->id)
                ->update(['user_id' => 0]);

            // reset the referral felid for the users
            User::where('ref_by', $user->id)
                ->update(['ref_by' => 0]);

            // Delete user commissions
            $user->commissions()->delete();

            // Delete user offers
            $user->offers()->delete();

            // Delete user chats
            $user->chats()->delete();

            try {
                // Delete user's leaderboard logs if applicable
                if (Route::has('leaderboards.*')) {
                    \Modules\Leaderboard\Entities\LeaderboardLog::where('user_id', $user->id)->delete();
                }

                // Delete user's daily task logs if applicable
                if (Route::has('dailytasks')) {
                    \Modules\DailyTasks\Entities\DailyTaskLog::where('user_id', $user->id)->delete();
                }
            } catch (\Exception $e) {
            }

            // Delete the user (assuming proper cascading deletes are defined)
            $user->delete();
        });

        // Redirect to a suitable route after account deletion
        return redirect('/');
    }
}
