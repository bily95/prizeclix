<?php

namespace App\Http\Livewire\Admin\Offerwall;

use Livewire\Component;
use App\Models\OfferLog;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Http\Controllers\OfferController;

class AdminOfferAnalysis extends Component
{
    use WithPagination;

    public $search;

    public $isPaid = false;

    protected $paginationTheme = 'bootstrap';


    public function mount(Request $request)
    {
        if($request->search)
            $this->search = $request->search;
        
        if($request->is_paid)
            $this->isPaid = $request->is_paid;
        
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sendPayment($offerId)
    {
        
        $offer = OfferLog::where('id', $offerId)->firstOrFail();

        (new OfferController)->rewardUser($offer->user_id, $offer->amount, $offer);

        $offer->update(['is_paid' => true]);

        $this->emit('showToast', 'success', 'The payment sent!');
    }

    public function reversePayment($offerId)
    {
        
        $offer = OfferLog::where('id', $offerId)->firstOrFail();

        (new OfferController)->reverseRewardUser($offer->user_id, $offer->amount, $offer);

        $offer->update(['is_paid' => false]);

        $this->emit('showToast', 'success', 'The payment reversed!');
    }

    public function delete($offerId)
    {
        
        $offer = OfferLog::where('id', $offerId)->firstOrFail();

        $offer->delete();

        $this->emit('showToast', 'success', 'The offer deleted!');
    }

    public function render()
    {

        $query = OfferLog::with(['users', 'offers'])->orderByDesc('created_at');

        if ($this->search) {
            $search = '%' . $this->search . '%';
            $query = $query->where('trx', 'like', $search)
            ->orWhere('offer_name', 'like', $search)
                ->orWhereHas('users', function ($query) use ($search) {
                    return $query->where('username', 'like', $search)
                     ->orWhere('email', 'like', $search)
                     ->orWhere('firstname', 'like', $search)
                     ->orWhere('lastname', 'like', $search);
                })
                ->orWhereHas('offers', function($query) use ($search) {
                    return $query->where('name', 'like', $search);
                });
        }

        if ($this->isPaid == 'paid') {
            $query = $query->where('is_paid', true);
        }

        if ($this->isPaid == 'not_paid') {
            $query = $query->where('is_paid', false);
        }

        return view('admin.offer-wall.livewire-analysis', [
            'offers' => $query->paginate(),
        ]);
    }
}
