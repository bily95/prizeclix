<?php


namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\WithdrawMethod;
use App\Rules\FileTypeValidate;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
  public function withdrawMoney()
  {
    $withdrawMethod = WithdrawMethod::where('status', 1)->get();
    $pageTitle = 'Withdraw Money';
    return view(SETTING['site_theme'] . 'withdraw.methods', compact('pageTitle', 'withdrawMethod'));
  }


  public function withdrawStore(Request $request)
  {

    $this->validate($request, [
      'method_code' => 'required',
      'amount' => 'required|numeric'
    ]);

    if (GENERAL_SETTING['withdraw_status'] == 0) {
      $notify[] = ['error', 'WE\'RE NOW OUT OF STOCK AND THE FUNDS WILL BE REFILLED SOON.THANKS FOR THE PATIENCE!'];
      return back()->withNotify($notify);
    }


    $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
    $user = auth()->user();

    if ($request->amount < $method->min_limit) {
      $notify[] = ['error', 'Your requested amount is smaller than minimum amount.'];
      return back()->withNotify($notify);
    }
    if ($request->amount > $method->max_limit) {
      $notify[] = ['error', 'Your requested amount is larger than maximum amount.'];
      return back()->withNotify($notify);
    }

    if ($request->amount > $user->balance) {
      $notify[] = ['error', 'You do not have sufficient balance for withdraw.'];
      return back()->withNotify($notify);
    }

    $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
    $afterCharge = $request->amount - $charge;
    $finalAmount = $afterCharge * $method->rate;

    $withdraw = new Withdrawal();
    $withdraw->method_id = $method->id; // wallet method ID
    $withdraw->user_id = $user->id;
    $withdraw->amount = $request->amount;
    $withdraw->currency = $method->currency;
    $withdraw->rate = $method->rate;
    $withdraw->charge = $charge;
    $withdraw->final_amount = $finalAmount;
    $withdraw->after_charge = $afterCharge;
    $withdraw->trx = getTrx();
    $withdraw->save();
    session()->put('wtrx', $withdraw->trx);
    return redirect()->route('user.withdraw.preview');
  }


  public function withdrawPreview()
  {
    $withdraw = Withdrawal::with('method', 'user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id', 'desc')->firstOrFail();
    $pageTitle = 'Withdraw Preview';
    return view(SETTING['site_theme'] . 'withdraw.preview', compact('pageTitle', 'withdraw'));
  }


  public function withdrawSubmit(Request $request)
  {
    $withdraw = Withdrawal::with('method', 'user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id', 'desc')->firstOrFail();

    $rules = [];
    $inputField = [];
    if ($withdraw->method->user_data != null) {
      foreach ($withdraw->method->user_data as $key => $cus) {
        $rules[$key] = [$cus->validation];
        if ($cus->type == 'file') {
          array_push($rules[$key], 'image');
          array_push($rules[$key], new FileTypeValidate(['jpg', 'jpeg', 'png']));
          array_push($rules[$key], 'max:2048');
        }
        if ($cus->type == 'text') {
          array_push($rules[$key], 'max:191');
        }
        if ($cus->type == 'textarea') {
          array_push($rules[$key], 'max:300');
        }
        $inputField[] = $key;
      }
    }

    $this->validate($request, $rules);

    $user = auth()->user();
    if ($user->ts) {
      $response = verifyG2fa($user, $request->authenticator_code);
      if (!$response) {
        $notify[] = ['error', 'Wrong verification code'];
        return back()->withNotify($notify);
      }
    }


    if ($withdraw->amount > $user->balance) {
      $notify[] = ['error', 'Your request amount is larger then your current balance.'];
      return back()->withNotify($notify);
    }

    $directory = date("Y") . "/" . date("m") . "/" . date("d");
    $path = imagePath()['verify']['withdraw']['path'] . '/' . $directory;
    $collection = collect($request);
    $reqField = [];
    if ($withdraw->method->user_data != null) {
      foreach ($collection as $k => $v) {
        foreach ($withdraw->method->user_data as $inKey => $inVal) {
          if ($k != $inKey) {
            continue;
          } else {
            if ($inVal->type == 'file') {
              if ($request->hasFile($inKey)) {
                try {
                  $reqField[$inKey] = [
                    'field_name' => $directory . '/' . uploadImage($request[$inKey], $path),
                    'type' => $inVal->type,
                  ];
                } catch (\Exception $exp) {
                  $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                  return back()->withNotify($notify)->withInput();
                }
              }
            } else {
              $reqField[$inKey] = $v;
              $reqField[$inKey] = [
                'field_name' => $v,
                'type' => $inVal->type,
              ];
            }
          }
        }
      }
      $withdraw['withdraw_information'] = $reqField;
    } else {
      $withdraw['withdraw_information'] = null;
    }


    $withdraw->status = 2;
    $withdraw->save();
    $user->balance -= $withdraw->amount;
    $user->save();


    //save transactions
    \App\Models\Transaction::store([
      'user' => $user,
      'amount' => getAmount($withdraw->amount),
      'from' => 'WITHDRAW_REQUEST',
      'source_id' => $withdraw->id,
      'details' => 'Request ' . $withdraw->amount . ' to withdraw',
    ], $withdraw->charge, '-');

    $adminNotification = new AdminNotification();
    $adminNotification->user_id = $user->id;
    $adminNotification->title = 'New withdraw request from ' . $user->username;
    $adminNotification->click_url = urlPath('moder.withdraw.details', $withdraw->id);
    $adminNotification->save();

    try {

      notify($user, 'WITHDRAW_REQUEST', [
        'method_name' => $withdraw->method->name,
        'method_currency' => $withdraw->currency,
        'method_amount' => showAmount($withdraw->final_amount),
        'amount' => showAmount($withdraw->amount),
        'charge' => showAmount($withdraw->charge),
        'currency' => GENERAL_SETTING['cur_text'],
        'rate' => showAmount($withdraw->rate),
        'trx' => $withdraw->trx,
        'post_balance' => showAmount($user->balance),
        'delay' => $withdraw->method->delay
      ]);
    } catch (\Exception $e) {
    }

    $notify[] = ['success', 'Withdraw request sent successfully'];
    return redirect()->route('user.withdraw.history')->withNotify($notify);
  }


  public function withdrawLog()
  {
    $pageTitle = "Withdraw Log";
    $withdraws = Withdrawal::where('user_id', Auth::id())->with('method')->orderBy('id', 'desc')->paginate();
    $data['emptyMessage'] = "No Data Found!";
    return view(SETTING['site_theme'] . 'withdraw.log', compact('pageTitle', 'withdraws'));
  }

  public function transactions()
  {
    $pageTitle = 'Transactions';
    $logs = auth()->user()->transactions()->orderBy('id', 'desc')->paginate();
    $empty_message = 'No transaction history';
    return view(SETTING['site_theme'] . 'transactions', compact('pageTitle', 'logs', 'empty_message'));
  }
}
