<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdsZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdsZoneController extends Controller
{


    public function index()
    {
        return view('admin.ads-zone.index', [
            'ads' => AdsZone::paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.ads-zone.index', [
            'create' => true,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'contents' => 'required|string|min:2',
            'size' => 'required|string|max:191',
        ]);

        AdsZone::addAds($validated);

        return redirect()->route('moder.ads.index')
            ->withNotify([['success', 'Your Ads added successfully']]);
    }


    public function edit($adsId)
    {
        return view('admin.ads-zone.index', [
            'ads' => AdsZone::findOrFail($adsId),
            'create' => true,
            'edit' => true,
        ]);
    }


    public function update(Request $request, $adsId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'contents' => 'required|string|min:2',
            'size' => 'required|string|max:191',
        ]);

        AdsZone::updateAds($adsId, $validated);

        return redirect()->route('moder.ads.index')
            ->withNotify([['success', 'Your Ads updated successfully']]);
    }


    public function destroy($adsId)
    {
        AdsZone::destroy($adsId);

        return redirect()->route('moder.ads.index')
            ->withNotify([['success', 'Your Ads deleted successfully']]);
    }
}
