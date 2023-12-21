<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Route;
use Livewire\Component;


class Control extends Component
{

    public $set, $timezones, $updateTimezone;

    protected $rules = [
        'set.registration' => 'nullable',
        'set.withdraw_status' => 'nullable',
        'set.reg_ref_bounce' => 'nullable',
        'set.force_ssl' => 'nullable',
        'set.secure_password' => 'nullable',
        'set.ev' => 'nullable',
        'set.en' => 'nullable',
        'set.cur_text' => 'nullable',
        'set.cur_sym' => 'nullable',
        'set.cur_rate' => 'nullable',
    ];

    public function mount()
    {
        $this->set = GeneralSetting::first();
        $this->timezones = json_decode(file_get_contents(resource_path('js/timezone.json')));
        $this->updateTimezone = config('timezone.timezone');

        $this->set['reg_ref_bounce'] = SETTING['reg_ref_bounce'];

    }

    public function route()
    {
        return Route::get('moder/setting/control', static::class)
            ->middleware(['auth', 'permission:admin'])
            ->name('moder.setting.control');
    }


    public function render()
    {
        return view('admin.setting.setup')
            ->layout('admin.layout.primary');
    }

    public function update()
    {
        $generalSetting =  GeneralSetting::first();

        $generalSetting::first()->update([
            'cur_text' => $this->set['cur_text'],
            'cur_sym' => $this->set['cur_sym'],
            'cur_rate' => $this->set['cur_rate'],
            'reg_ref_bounce' => $this->set['reg_ref_bounce'],
            'registration' => boolval($this->set['registration']) ? 1 : 0,
            'withdraw_status' => boolval($this->set['withdraw_status']) ? 1 : 0,
            'force_ssl' => boolval($this->set['force_ssl']) ? 1 : 0,
            'secure_password' => boolval($this->set['secure_password']) ? 1 : 0,
            'ev' => boolval($this->set['ev']) ? 1 : 0,
            'en' => boolval($this->set['en']) ? 1 : 0,
        ]);

        $timezoneFile = config_path('timezone.php');
        $content = '<?php return[ "timezone" => "' . $this->updateTimezone . '" ]; ?>';
        file_put_contents($timezoneFile, $content);

        $this->emit('showToast', 'info', 'Setting updated');
    }
}
