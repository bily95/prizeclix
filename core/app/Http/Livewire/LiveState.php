<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class LiveState extends Component
{

    public $perPage = 15;

    public function render()
    {
        return view(SETTING['site_theme'] . 'addons.live-activity.index', [
            'statists' => Transaction::with(['user:id,username', 'user.profile:user_id,image'])
                ->orderBy('created_at', 'desc')
                ->limit(15)
                ->get(),
        ]);
    }
}
