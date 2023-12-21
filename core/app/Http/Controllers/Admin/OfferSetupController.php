<?php

namespace App\Http\Controllers\Admin;

use App\Models\OfferLog;
use App\Models\OfferSetup;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;

class OfferSetupController extends Controller
{

    public function index()
    {
        return view('admin.offer-wall.list', [
            'offers' => OfferSetup::where('is_builtin', false)->paginate(),
        ]);
    }

    public function create(){
        return view('admin.offer-wall.index');
    }

    public function store(OfferRequest $request)
    {
        $validated = $request->validated();

        $validated['image'] = $this->imageName($request);

        $validated['endpoint'] = md5($validated['image']);

        $validated['is_active'] = $request->is_active ? 1 : 0;
        $validated['is_auto_pay'] = $request->is_auto_pay ? 1 : 0;
        $validated['is_available'] = $request->is_available ? 1 : 0;

        OfferSetup::create($validated);

        return redirect()->route('moder.offer.index')
            ->withNotify([['Success', 'OfferWall created Successfully']]);
    }

    public function edit($offerId)
    {

        $offer = OfferSetup::where('id', $offerId)->firstOrFail();

        return view('admin.offer-wall.edit', compact('offer'));
    }

    public function update(OfferRequest $request, $offerId)
    {

        $validated = $request->validated();

        $offer = OfferSetup::where('id', $offerId)->firstOrFail();

        $validated['image'] = $request->hasFile('image') ? $this->imageName($request, $offer) : $offer->image;

        $validated['is_active'] = $request->is_active ? 1 : 0;
        $validated['is_auto_pay'] = $request->is_auto_pay ? 1 : 0;
        $validated['is_available'] = $request->is_available ? 1 : 0;
        
        $offer->update($validated);

        return redirect()->route('moder.offer.index')
            ->withNotify([['Success', 'OfferWall Updated Successfully']]);
    }
   

    public function updateStatus($offerId)
    {
        $offer = OfferSetup::where('id', $offerId)->firstOrFail();

        $offer->update([
            'is_active' => !$offer->is_active,
        ]);

        return back()->withNotify([['Success', 'Offerwall Updated Successfully']]);
    }

    public function updatePay($offerId)
    {
        $offer = OfferSetup::where('id', $offerId)->firstOrFail();

        $offer->update([
            'is_auto_pay' => !$offer->is_auto_pay,
        ]);

        return back()->withNotify([['Success', 'OfferWall Updated Successfully']]);
    }

    public function delete($offerId)
    {

        $offer = OfferSetup::where('id', $offerId)->firstOrFail();

        $offer->delete();

        return back()->withNotify([['Success', 'OfferWall Deleted Successfully']]);
    }

    public function analysis()
    {
        return view('admin.offer-wall.analysis',
        ['offers' => OfferLog::all()]
        );
    }

    public function imageName($request, $offer = null)
    {
        $filename = null;

        $path = imagePath()['offers']['path'];
        $size = imagePath()['offers']['size'];
        
        if ($request->hasFile('image')) {
            if($request->image->getClientOriginalExtension() == 'svg'){
                try {
                    $offer
                     ? $filename = uploadFile($request->image, $path, $size, $offer->image)
                     : $filename = uploadFile($request->image, $path, $size);
                } catch (\Exception $exp) {
                    $notify[] = ['Error', 'Image Could not be Uploaded.'];
                    return back()->withNotify($notify);
                }
            }else{
                try {
                    $offer
                     ? $filename = uploadImage($request->image, $path, $size, $offer->image)
                     : $filename = uploadImage($request->image, $path, $size);
                } catch (\Exception $exp) {
                    $notify[] = ['Error', 'Image Could not be Uploaded.'];
                    return back()->withNotify($notify);
                }
            }
        }

        return  $filename;
    }

}
