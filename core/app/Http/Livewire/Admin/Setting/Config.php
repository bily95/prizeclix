<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Route;


class Config extends Component
{

    public $systemConfig;
    public $name;

    public function mount()
    {
        $this->name = SETTING;
    }

    public function route()
    {
        return Route::get('admin/antifraud', static::class)
            ->name('moder.offers.config')
            ->middleware(['auth', 'permission:admin']);
    }


    public function render()
    {
        return view('admin.offer-wall.setup')
            ->layout('admin.layout.primary');
    }

    public function rules()
    {

        return [
            'name' => 'nullable',
        ];
    }

    public function save()
    {
        $this->validate();

        foreach ($this->name as $name => $value) {
            Setting::where('name', $name)->update(['value' => $value]);
        }
        $this->emit('showToast', 'info', __('Settings saved!'));
    }
}
