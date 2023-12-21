<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\EmailLog;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\WithdrawMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageUsersController extends Controller
{
    public function usersMap()
    {
        $data = DB::select('SELECT count(DISTINCT(user_id)) as users, country_code FROM `user_logins` GROUP by country_code');

        $response = array();
        foreach ($data as $d) {
            $country_code = $d->country_code;
            if ($country_code) {
                $response[$country_code] = $d->users;
            }
        }
        return response()->json($response);
    }

    public function allUsers()
    {
        $pageTitle = 'Manage Users';
        $emptyMessage = 'No user found';
        $users = User::orderBy('id', 'desc')->paginate();
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function activeUsers()
    {
        $pageTitle = 'Manage Active Users';
        $emptyMessage = 'No active user found';
        $users = User::active()->orderBy('id', 'desc')->paginate();
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function bannedUsers()
    {
        $pageTitle = 'Banned Users';
        $emptyMessage = 'No banned user found';
        $users = User::banned()->orderBy('id', 'desc')->paginate();
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function emailUnverifiedUsers()
    {
        $pageTitle = 'Email Unverified Users';
        $emptyMessage = 'No email unverified user found';
        $users = User::emailUnverified()->orderBy('id', 'desc')->paginate();
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function emailVerifiedUsers()
    {
        $pageTitle = 'Email Verified Users';
        $emptyMessage = 'No email verified user found';
        $users = User::emailVerified()->orderBy('id', 'desc')->paginate();
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }



    public function usersWithBalance()
    {
        $pageTitle = 'Users with balance';
        $emptyMessage = 'No sms verified user found';
        $users = User::where('balance', '!=', 0)->orderBy('id', 'desc')->paginate();
        return view('admin.users.list', compact('pageTitle', 'emptyMessage', 'users'));
    }


    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $users = User::where(function ($user) use ($search) {
            $user->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });
        $pageTitle = '';
        if ($scope == 'active') {
            $pageTitle = 'Active ';
            $users = $users->where('status', 1);
        } elseif ($scope == 'banned') {
            $pageTitle = 'Banned';
            $users = $users->where('status', 0);
        } elseif ($scope == 'emailUnverified') {
            $pageTitle = 'Email Unverified ';
            $users = $users->where('ev', 0);
        } elseif ($scope == 'smsUnverified') {
            $pageTitle = 'SMS Unverified ';
            $users = $users->where('sv', 0);
        } elseif ($scope == 'withBalance') {
            $pageTitle = 'With Balance ';
            $users = $users->where('balance', '!=', 0);
        }

        $users = $users->paginate();
        $pageTitle .= 'User Search - ' . $search;
        $emptyMessage = 'No search result found';
        return view('admin.users.list', compact('pageTitle', 'search', 'scope', 'emptyMessage', 'users'));
    }


    public function detail($id)
    {
        $pageTitle = 'User Detail';
        $user = User::with('profile')->findOrFail($id);
        $userAddress = json_decode($user->profile->address, true);
        $totalWithdraw = Withdrawal::where('user_id', $user->id)->where('status', 1)->sum('amount');
        $totalTransaction = Transaction::where('user_id', $user->id)->count();
        $countries = getCountries();

        $cardsInfo = [
            'balance' => [
                'value' => showAmount($user->balance),
                'text' => 'Total Balance',
                'link' => route('moder.users.transactions', $user->id),
            ],
            'withdrawals' => [
                'value' => showAmount($totalWithdraw),
                'text' => 'Total withdrawal',
                'link' => route('moder.users.withdrawals', $user->id),
            ],
            'transactions' => [
                'value' => showAmount($totalTransaction),
                'text' => 'Total Transactions',
                'link' => route('moder.users.transactions', $user->id),
            ],
            'referrals' => [
                'value' => $user->referral->count(),
                'text' => 'Total Referrals',
                'link' => route('moder.users.referrals', $user->id),
            ],
            'commissions' => [
                'value' => showAmount($user->commissions->sum('amount')),
                'text' => 'Total Commissions',
                'link' => route('moder.users.commissions.win', $user->id),
            ],
        ];


        $reff = User::where('id', $user->ref_by)->first();

        return view('admin.users.detail', compact('user', 'cardsInfo', 'userAddress', 'countries', 'reff'));
    }


    public function update(Request $request, $id)
    {

        $user = User::with('profile')->findOrFail($id);

        User::where('id', $user->id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'status' => $request->status ? 1 : 0,
            'ev' => $request->ev ? 1 : 0,
            'sv' => $request->sv ? 1 : 0,
            'ts' => $request->ts ? 1 : 0,
            'tv' => $request->tv ? 1 : 0,
            'ref_bounce' => $request->ref_bounce ? 1 : 0,
            'active_status_by_admin' => $request->active_status_by_admin ? 1 : 0
        ]);

        $user->profile->update([
            'address' => json_encode($request->address)
        ]);

        $notify[] = ['success', 'User detail has been updated'];
        return redirect()->back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $user = User::findOrFail($id);
        $amount = $request->amount;
        
        $trx = getTrx();

        if ($request->act) {
            $user->balance += $amount;
            $user->save();
            $notify[] = ['success', GENERAL_SETTING['cur_sym'] . $amount . ' has been added to ' . $user->username . '\'s balance'];

            //save transactions
            \App\Models\Transaction::store([
                'user' => $user,
                'amount' => getAmount($amount),
                'from' => 'ADMIN_ADD_BALANCE',
                'details' => 'balance added by admin'
            ]);

            notify($user, 'BAL_ADD', [
                'trx' => $trx,
                'amount' => showAmount($amount),
                'currency' => GENERAL_SETTING['cur_text'],
                'post_balance' => showAmount($user->balance),
            ]);
        } else {
            if ($amount > $user->balance) {
                $notify[] = ['error', $user->username . '\'s has insufficient balance.'];
                return back()->withNotify($notify);
            }
            $user->balance -= $amount;
            $user->save();

            //save transactions
            \App\Models\Transaction::store([
                'user' => $user,
                'amount' => getAmount($amount),
                'from' => 'ADMIN_SUBTRACT_BALANCE',
                'details' => 'balance subtract by admin'
            ], 0, '-');

            notify($user, 'BAL_SUB', [
                'trx' => $trx,
                'amount' => showAmount($amount),
                'currency' => GENERAL_SETTING['cur_text'],
                'post_balance' => showAmount($user->balance)
            ]);
            $notify[] = ['success', GENERAL_SETTING['cur_sym'] . $amount . ' has been subtracted from ' . $user->username . '\'s balance'];
        }
        return back()->withNotify($notify);
    }


    public function userLoginHistory($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'User Login History - ' . $user->username;
        $emptyMessage = 'No users login found.';
        $login_logs = $user->login_logs()->orderBy('id', 'desc')->paginate();
        return view('admin.users.reports.logins', compact('pageTitle', 'emptyMessage', 'login_logs'));
    }


    public function showEmailSingleForm($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'Send Email To: ' . $user->username;
        return view('admin.users.mail.email_single', compact('pageTitle', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = User::findOrFail($id);
        sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function transactions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search User Transactions : ' . $user->username;
            $transactions = $user->transactions()->where('trx', $search)->with('user')->orderBy('id', 'desc')->paginate();
            $emptyMessage = 'No transactions';
            return view('admin.reports.transactions', compact('pageTitle', 'search', 'user', 'transactions', 'emptyMessage'));
        }
        $pageTitle = 'User Transactions : ' . $user->username;
        $transactions = $user->transactions()->with('user')->orderBy('id', 'desc')->paginate();
        $emptyMessage = 'No transactions';
        return view('admin.reports.transactions', compact('pageTitle', 'user', 'transactions', 'emptyMessage'));
    }


    public function withdrawals(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $pageTitle = 'Search User Withdrawals : ' . $user->username;
            $withdrawals = $user->withdrawals()->where('trx', 'like', "%$search%")->orderBy('id', 'desc')->paginate();
            $emptyMessage = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('pageTitle', 'user', 'search', 'withdrawals', 'emptyMessage'));
        }
        $pageTitle = 'User Withdrawals : ' . $user->username;
        $withdrawals = $user->withdrawals()->orderBy('id', 'desc')->paginate();
        $emptyMessage = 'No withdrawals';
        $userId = $user->id;
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'user', 'withdrawals', 'emptyMessage', 'userId'));
    }

    public function withdrawalsViaMethod($method, $type, $userId)
    {
        $method = WithdrawMethod::findOrFail($method);
        $user = User::findOrFail($userId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Withdrawal of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', 1)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate();
        } elseif ($type == 'rejected') {
            $pageTitle = 'Rejected Withdrawals of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', 3)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate();
        } elseif ($type == 'pending') {
            $pageTitle = 'Pending Withdrawals of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', 2)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate();
        } else {
            $pageTitle = 'Withdrawals of ' . $user->username . ' Via ' . $method->name;
            $withdrawals = Withdrawal::where('status', '!=', 0)->where('user_id', $user->id)->with(['user', 'method'])->orderBy('id', 'desc')->paginate();
        }
        $emptyMessage = 'Withdraw Log Not Found';
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'withdrawals', 'emptyMessage', 'method'));
    }

    public function showEmailAllForm()
    {
        $pageTitle = 'Send Email To All Users';
        return view('admin.users.mail.email_all', compact('pageTitle'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (User::where('status', 1)->cursor() as $user) {
            sendGeneralEmail($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All users will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function login($id)
    {
        $user = User::findOrFail($id);
        Auth::login($user);
        return redirect()->route('user.home');
    }

    public function emailLog($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'Email log of ' . $user->username;
        $logs = EmailLog::where('user_id', $id)->with('user')->orderBy('id', 'desc')->paginate();
        $emptyMessage = 'No data found';
        return view('admin.users.reports.email_log', compact('pageTitle', 'logs', 'emptyMessage', 'user'));
    }

    public function emailDetails($id)
    {
        $email = EmailLog::findOrFail($id);
        $pageTitle = 'Email details';
        return view('admin.users.mail.email_details', compact('pageTitle', 'email'));
    }

    public function wins($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'User Wins : ' . $user->username;
        $winners = $user->wins()->latest()->with('tickets', 'lotteries', 'tickets.user')->paginate();
        $empty_message = 'No wins';
        return view('admin.reports.winners', compact('pageTitle', 'user', 'winners', 'empty_message'));
    }

    public function tickets($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'User Tickets : ' . $user->username;
        $tickets = $user->lotteryTickets()->latest()->with('lottery', 'phase', 'user')->paginate();
        $empty_message = 'No tickets found';
        return view('admin.users.tickets', compact('pageTitle', 'user', 'tickets', 'empty_message'));
    }


    public function referrals($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'User Referrals - ' . $user->username;
        $referrals = User::where('ref_by', $user->id)->orderBy('id', 'desc')->paginate();
        return view('admin.users.reports.referral', compact('pageTitle', 'user', 'referrals'));
    }

    public function referralCommissionsWin(Request $request, $id)
    {
        $search = $request->search;

        $user = User::findOrFail($id);
        $pageTitle = 'User Commission Log: ' . $user->username;
        $logs = $user->commissions()
            ->where('commission_type', 'win');

        if ($search) {
            $logs = $logs->where('trx', 'like', "%$search%");
        }

        $logs = $logs->with('user', 'bywho')
            ->paginate();

        $empty_message = 'No Data Found!';
        return view('admin.users.reports.commission-log', compact('pageTitle', 'user', 'logs', 'empty_message'));
    }
}
