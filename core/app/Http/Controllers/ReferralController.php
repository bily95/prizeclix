<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CommissionLog;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
  public function index()
  {
    $user = auth()->user();

    $totalReferrals = User::where('ref_by', $user->id)->count();
    $totalCommission = $user->commissions->sum('amount');

    $userRefLink = route('welcome') . '?join=' . $user->token_id;

    $commissions = CommissionLog::where('to_id', $user->id)
      ->orderBy('id', 'desc')
      ->with('bywho')
      ->paginate();

    return view(
      SETTING['site_theme'] . 'referral.index',
      compact(
        'user',
        'totalReferrals',
        'totalCommission',
        'userRefLink',
        'commissions'
      )
    );
  }
}
