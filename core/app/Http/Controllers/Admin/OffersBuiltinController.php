<?php 

namespace App\Http\Controllers\Admin;

use App\Models\OfferSetup;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;

class OffersBuiltinController extends Controller
{

    public function index(Request $request)
    {
        (new OfferSetup())->checkEnableAPIColumn();

        $offers = OfferSetup::where('is_builtin', true);
        
        if($request->search)
            $offers->where('name', 'like', '%' . $request->search . '%');
        
        return view('admin.offer-wall.builtin.list', [
            'offers' => $offers->paginate(10),
        ]);
    }

    public function edit($offer_id)
    {
        return view('admin.offer-wall.builtin.edit', [
            'offer' => OfferSetup::findOrFail($offer_id),
        ]);

    }


    public function update(OfferRequest $request, $offerId)
    {
        $validated = $request->validated();

        $offer = OfferSetup::where('id', $offerId)->firstOrFail();

        $validated['image'] = $request->hasFile('image') ? $this->imageName($request, $offer) : $offer->image;

        $validated['is_active'] = $request->is_active ? 1 : 0;
        $validated['is_auto_pay'] = $request->is_auto_pay ? 1 : 0;
        $validated['is_available'] = $request->is_available ? 1 : 0;
        $validated['en_api'] = $request->en_api ? 1 : 0;

        $offer->update($validated);
        
        return redirect()->route('moder.offer.builtin.index')
            ->withNotify([['success', 'OfferWall Updated Successfully']]);
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
                    $notify[] = ['error', 'Image Could not be Uploaded.'];
                    return back()->withNotify($notify);
                }
            }else{
                try {
                    $offer
                     ? $filename = uploadImage($request->image, $path, $size, $offer->image)
                     : $filename = uploadImage($request->image, $path, $size);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Image Could not be Uploaded.'];
                    return back()->withNotify($notify);
                }
            }
        }

        return  $filename;
    }

}