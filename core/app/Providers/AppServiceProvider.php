<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Setting::getAll();

        define('SETTING', $settings);
        define('GENERAL_SETTING', (new GeneralSetting())->first());

        if (is_local()) {
            Config::set([
                'app.env' => 'local',
                'app.debug' => true,
            ]);
        }

        Config::set([
            'services.google.client_id' => $settings['google_client_id'],
            'services.google.client_secret' => $settings['google_secret_key'],
        ]);
    }
}
