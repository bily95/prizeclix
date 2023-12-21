<?php

namespace Modules\OffersNetwork\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\OfferSetup;
use Modules\OffersNetwork\Entities\OffersStorage;

class ManageOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Initialize the query with eager loading of 'provider' relationship
        $offers = OffersStorage::with('provider');

        // Search functionality
        if ($request->s) {
            $searchTerm = '%' . $request->s . '%';
            $offers = $offers->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            });
        }

        // Filter by is_completed
        if ($request->has('is_completed') && $request->is_completed !== 'all') {
            $offers = $offers->where('is_completed', (bool)$request->is_completed);
        }

        // Filter by is_banner
        if ($request->has('is_banner') && $request->is_banner !== 'all') {
            $offers = $offers->where('is_banner', (bool)$request->is_banner);
        }

        // Filter by is_active
        if ($request->has('is_active') && $request->is_active !== 'all') {
            $offers = $offers->where('is_active', (bool)$request->is_active);
        }

        // Filter by provider
        if ($request->provider && $request->provider !== 'all') {
            $offers = $offers->whereHas('provider', function ($q) use ($request) {
                $q->where('name', $request->provider);
            });
        }

        // Retrieve all providers
        $providers = OfferSetup::all();

        // Paginate the results
        $offers = $offers->paginate();

        return view('offersnetwork::admin.manage-offers.index', compact('offers', 'providers'));
    }

    /**
     * Update offer's is_banner attribute.
     *
     * @param int $offerId
     * @return Redirect
     */
    public function changeIsBanner($offerId)
    {
        $offer = OffersStorage::findOrFail($offerId);

        $offer->update([
            'is_banner' => !$offer->is_banner,
        ]);

        return back()->withNotify([['success', 'The offer is updated']]);
    }

    /**
     * Update offer's is_active attribute.
     *
     * @param int $offerId
     * @return Redirect
     */
    public function changeIsActive($offerId)
    {
        $offer = OffersStorage::findOrFail($offerId);

        $offer->update([
            'is_active' => !$offer->is_active,
        ]);

        return back()->withNotify([['success', 'The offer is updated']]);
    }

    /**
     * Update offer's is_completed attribute.
     *
     * @param int $offerId
     * @return Redirect
     */
    public function changeIsCompleted($offerId)
    {
        $offer = OffersStorage::findOrFail($offerId);

        $offer->update([
            'is_completed' => !$offer->is_completed,
        ]);

        return back()->withNotify([['success', 'The offer is updated']]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Redirect
     */
    public function destroy(Request $request)
    {
        OffersStorage::destroy($request->id);

        return back()->withNotify([['success', 'The offer is deleted']]);
    }
}
