<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;

class Authentication extends Component
{
    public $setting;


    public function mount()
    {
        $this->setting = SETTING;
        $this->setting['enable_google_auth'] = (bool)$this->setting['enable_google_auth'];
    }

    public function save()
    {
        
        Setting::where('name', 'enable_google_auth')
            ->update(['value' => $this->setting['enable_google_auth'] ? 1 : 0]);

        foreach ($this->setting as $key => $value) {
            Setting::where('name', $key)
                ->update(['value' => $value]);
        }

        $this->emit('showToast', 'info', __('Settings Saved!'));
    }

    public function render()
    {

        return view('admin.setting.authentication')
            ->layout('admin.layout.primary');
    }
}
