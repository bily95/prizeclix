<?php

namespace App\Http\Livewire;


use App\Models\User;
use Livewire\Component;
use App\Models\OfferSetup;
use Illuminate\Support\Facades\Route;
use Modules\OffersNetwork\Http\Controllers\OffersNetworkController;

class Home extends Component
{
    public $data = [], $user;

    public function route()
    {
        return Route::get('earn', static::class)
            ->middleware(['auth', 'checkStatus'])->name('user.home');
    }


    public function mount()
    {

        $this->user = User::findOrFail(auth()->user()->id);

        $this->fill([
            'data' => [
                'offers' => OfferSetup::active()->select(
                    'name',
                    'id',
                    'iframe_url',
                    'image',
                    'is_active',
                    'is_available',
                    'bgcolor',
                    'user_level'
                )
                    ->get(),
            ],
        ]);
    }

    public function render()
    {

        $fetchedOffers = OffersNetworkController::getOffers();

        return view(SETTING['site_theme'] . 'home', [
            'bannerOffers' => $fetchedOffers['bannerOffers'],
            'offersWithCategories' => $fetchedOffers['offersWithCategories'],
        ])->layout(SETTING['site_theme'] . 'layouts.app');
    }
}
