<?php

namespace Modules\Coupon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Coupon\Entities\Coupon;
use Illuminate\Contracts\Support\Renderable;
use Modules\Coupon\Entities\CouponLog;
use Modules\Coupon\Http\Requests\CouponRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('coupon::admin.index', [
            'coupons' => Coupon::with('log')->orderBy('expire_at',  'desc')
                ->paginate(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CouponRequest $request)
    {
        $validate = $request->validated();

        Coupon::create($validate);

        return back()->withNotify([['info', 'New Coupon Added']]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request)
    {
        return response()->json([
            'coupon' => Coupon::findOrFail($request->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CouponRequest $request)
    {
        $validate = $request->validated();

        Coupon::where('id', $request->id)->update($validate);

        return back()->withNotify([['info', 'The Coupon Updated']]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Coupon::destroy($id);

        return back()->withNotify([['info', 'The Coupon Deleted!']]);
    }

    /**
     * change status for the specified resource from storage.
     * @param int $id
     * @return Renderable
     */  
    public function changeStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'status' => !$coupon->status
        ]);

        return back()->withNotify([['info', 'The Coupon Updated!']]);
    }

    /**
     * change status for the specified resource from storage.
     * @param int $id
     * @return Renderable
     */  
    public function history(Request $request)
    {
        $logs = CouponLog::with('coupon','user')
        ->orderByDesc('created_at');

        if($request->s){
            $search = $request->s;
            $logs = $logs->whereHas('coupon', function($q) use ($search){
                $q->where('token', 'like', "%$search%");
            })
            ->orWhereHas('user', function($q) use ($search){
                $q->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%");
            });
        }

        $logs = $logs->paginate();

        return view('coupon::admin.history', compact('logs'));
    }
}
