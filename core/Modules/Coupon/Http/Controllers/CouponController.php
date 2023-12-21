<?php

namespace Modules\Coupon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Entities\CouponLog;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return redirect
     */
    public function click(Request $request)
    {
        $request->validate([
            'coupon' => 'required|string|min:5|max:191'
        ]);

        $coupon = Coupon::with('log')
            ->where('status', 1)
            ->where('token', $request->coupon)
            ->first();

        if ($coupon == null || $coupon->log->count() >= $coupon->limit || $coupon->expire_at <= today()) {
            return back()->withNotify([['error', 'Invalid coupon code']]);
        }

        if ($coupon->log
            ->where('coupon_id', $coupon->id)
            ->where('user_id', auth()->id())->count() > 1
        ) {
            return back()->withNotify([['error', 'You already claimed the coupon code']]);
        }


        auth()->user()->increment('balance', $coupon->rewards);

        $log = CouponLog::create([
            'user_id' => auth()->id(),
            'coupon_id' => $coupon->id
        ]);

        \App\Models\Transaction::store([
            'user' => auth()->user(),
            'amount' => getAmount($coupon->rewards),
            'from' => 'COUPON',
            'source_id' => $log->id,
            'details' => 'Coupon claim'
        ]);
 
        return back()->withNotify([['info', 'congrats!, You Earned ' . $coupon->rewards]]);

        return view('coupon::index');
    }
}
