<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\OfferLog;
use App\Models\OfferSetup;
use Illuminate\Support\Facades\DB;
use Modules\OffersNetwork\Http\Controllers\OffersNetworkController;

class Welcome extends Component
{

    public $user;


    public function mount()
    {
        $this->user = auth()->user();
    }

    /**
     * getCompletedOffers
     **/
    public function getCompletedOffers()
    {
        return OfferLog::where('is_paid', true)->count();
    }


    public function getTotalPaid()
    {
        return OfferLog::where('is_paid', true)->sum('amount');
    }

    public function averageDailyEarnings()
    {
        return OfferLog::select(DB::raw('AVG(amount) as average_daily_earnings'))
            ->whereDay('created_at', \Carbon\Carbon::today()->subDay())
            ->pluck('average_daily_earnings')
            ->avg();
    }


    public function home()
    {


        if (request()->join) {
            session(['reference' => request()->join]);
        }

        $fetchedOffers = OffersNetworkController::getOffers();

        $data = [];

        $data['offers'] = OfferSetup::active()->select(
            'name',
            'id',
            'iframe_url',
            'image',
            'is_active',
            'is_available',
            'bgcolor',
            'user_level'
        )->get();

        return view(SETTING['site_theme'] . '/welcome', [
            'bannerOffers' => $fetchedOffers['bannerOffers'],
            'offersWithCategories' => $fetchedOffers['offersWithCategories'],
            'getCompletedOffers' => $this->getCompletedOffers(),
            'getTotalPaid' => $this->getTotalPaid(),
            'averageDailyEarnings' => $this->averageDailyEarnings(),
            'data' => $data,
        ]);
    }
}
