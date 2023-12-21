<?php

namespace Modules\OffersNetwork\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OffersNetwork\Entities\Category;
use Modules\OffersNetwork\Entities\OffersStorage;
use Modules\OffersNetwork\Entities\OffersTrack;

class OffersNetworkController extends Controller
{

    public function index(Request $request)
    {

        $page = request()->input('page');

        $offers = OffersStorage::filter()
            ->where('name', 'like', "%" . $request->name . "%")
            ->orWhere('description', 'like', "%" . $request->name . "%");

        if ($request->orderBy) {
            switch ($request->orderBy) {
                case 'HightPaying':
                    $offers = $offers->orderBy('rewards');
                    break;

                default:
                    $offers = $offers->inRandomOrder();
                    break;
            }
        }


        $offers = $offers->paginate(15, ['*'], 'page', $page);

        if (request()->ajax()) {
            return view('offersnetwork::user.load-more-offers', compact('offers'));
        }

        return view('offersnetwork::user.list', compact('offers'));
    }

    /**
     * Display a listing of the resource.
     */
    public static function getOffers($limit = 10)
    {

        $bannerOffers = OffersStorage::active()->isBanner()->get();

        $categories = Category::select('id', 'name')->active()->limit(15)->get();

        $offersWithCategories = [];

        foreach ($categories as $category) {

            $cate = Str::limit($category->name, 3, '');

            $offersWithCategories[] = [
                'id' => $category->id,
                'name' => $category->name,
                'offers' => OffersStorage::filter()->where('category', 'like', "%" . $cate . "%")->limit($limit)->get(),
            ];
        }

        return [
            'bannerOffers' => $bannerOffers,
            'offersWithCategories' => $offersWithCategories,
        ];
    }

    public function browse($categoryId, $categoryName)
    {
        $page = request()->input('page');
        $category_id = request()->input('categoryId') ? request()->input('categoryId') : $categoryId;
        $perPage = 15; // Adjust the per page count as needed

        $category = Category::findOrFail($category_id);

        $cate = Str::limit($category->name, 3, '');

        $offers = OffersStorage::filter()
            ->where('category', 'like', "%" . $cate . "%")
            ->paginate($perPage, ['*'], 'page', $page);


        if (request()->ajax()) {
            return view('offersnetwork::user.load-more-offers', compact('offers', 'category'));
        }

        return view('offersnetwork::user.browse', compact('offers', 'category'));
    }


    public function details(Request $request)
    {
        $html = view('offersnetwork::user.offer-details', [
            'offer' => OffersStorage::findOrFail($request->id),
        ])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function click($offerId)
    {
        $offer = OffersStorage::findOrFail($offerId);
        $url = Str::replace('{user}', auth()->id(), $offer->click_url);

        OffersTrack::updateOrCreate([
            'user_id' => auth()->id(),
            'offer_id' => $offer->id,
            'provider_id' => $offer->provider_id,
        ], [
            'uid' => getTrx(),
        ]);

        return redirect()->away($url);
    }

    public  static function displayOfferDevice($deviceType)
    {
        $icon = '<i class="fab fa-apple" role="button" title="' . $deviceType . '"></i>';

        switch (strtolower($deviceType)) {
            case 'windows':
                $icon = '<i class="fas me-2 fa-desktop" role="button" title="' . $deviceType . '"></i>';
                break;
            case 'android':
                $icon = '<i class="fab me-2 fa-android" role="button" title="' . $deviceType . '"></i>';
                break;
            case 'ipad':
                $icon = '<i class="fas me-2 fa-tablet-alt" role="button" title="' . $deviceType . '"></i>';
                break;
            case 'iphone':
                $icon = '<i class="fas me-2 fa-mobile-alt" role="button" title="' . $deviceType . '"></i>';
                break;
        }

        return $icon;
    }
}
