<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\FileTypeValidate;


class General extends Component
{

    use WithFileUploads;

    public $setting;

    public $siteSocialImage,
        $siteLogoImage,
        $siteSmallLogoImage,
        $siteFaviconImage,
        $siteLoadingImage;

    public function mount()
    {
        $this->setting = SETTING;
    }


    public function render()
    {
        return view('admin.setting.general')
            ->layout('admin.layout.primary');
    }


    public function save()
    {

        $this->uploadImage('siteSocialImage');

        foreach ($this->setting as $key => $value) {
            Setting::where('name', $key)
                ->update(['value' => $value]);
        }

        $this->emit('showToast', 'info', __('Settings saved!'));
    }

    public function saveSiteLogoAndFavicon()
    {
        $this->uploadImage('siteLoadingImage');

        $this->uploadImage('siteLogoImage');
        
        $this->uploadImage('siteSmallLogoImage');

        $this->uploadImage('siteFaviconImage');

        $this->save();
    }


    protected function uploadImage($file)
    {
        if ($this->$file) {
            $this->validate([$file => ['image', new FileTypeValidate(['png', 'jpg'])]]);

            $this->setting[$file] = uploadImage(
                $this->$file,
                'asset/uploads/setting',
                null,
                $this->setting[$file]
            );
        }
    }
}
