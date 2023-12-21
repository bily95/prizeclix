@section('title', __('Captcha Settings'))
@section('page-title', __('Captcha Setting'))

<div>
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h2  style="margin-top:10px;"class="card-title">@lang('Basic Settings') </h2>

                    </div>
                    <div class="card-body">

                        <!-- start form for validation -->
                        <form class="demo-form" data-parsley-validate wire:submit.prevent="save">
                            <div class="form-group">
                                <label>@lang('Enable Captcha on Registration Page')</label>
                                <select wire:model="setting.en_cap_register" class="form-control">
                                    <option value="1">@lang('Enable')</option>
                                    <option @if (SETTING['en_cap_register'] == '0') selected="selected" @endif value="0">
                                        @lang('Disable')
                                    </option>
                                </select>
                                <div class="form-group" style="margin-top:10px;">
                                    <label>@lang('Enable Captcha on Login page')</label>
                                    <select wire:model="setting.en_cap_login" class="form-control">
                                        <option value="1">@lang('Enable')</option>
                                        <option @if (SETTING['en_cap_login'] == '0') selected="selected" @endif value="0">
                                            @lang('Disable')
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:10px;">
                                <label>Default Captcha</label>
                                <select wire:model="setting.default_captcha" class="form-control">
                                    <option value="Recaptcha"> @lang('Recaptcha')</option>
                                    <option value="hcaptcha"
                                        @if (SETTING['default_captcha'] == 'hcaptcha') selected="selected" @endif>
                                        @lang('Hcptcha')
                                    </option>
                                   
                                </select>
                            </div>
                            <input type="submit" class="btn btn-success" value="save" style="margin-top:20px;box-shadow:none;background:#067fda;border-color:#067fda;" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h2 style="margin-top:10px;"class="card-title">@lang('Google Recaptcha') </h2>

                    </div>
                    <div class="card-body">

                        <!-- start form for validation -->
                        <form class="demo-form" data-parsley-validate wire:submit.prevent="save">
                            <div class="form-group">
                                <label>@lang('Recaptcha Public Key')</label>
                                <input type="text" class="form-control" wire:model="setting.re_public_key"
                                    value="{{ SETTING['re_public_key'] }}">
                            </div>
                            <div class="form-group" style="margin-top:10px;">
                                <label>@lang('Recaptcha Secret Key')</label>
                                <input type="text" class="form-control" wire:model="setting.re_secret_key"
                                    value="{{ SETTING['re_secret_key'] }}">
                            </div>
                            <input type="submit" class="btn btn-success" value="@lang('save')"style="margin-top:20px;box-shadow:none;background:#067fda;border-color:#067fda;" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h2  style="margin-top:10px;" class="card-title">@lang('Hcaptcha Setup') </h2>

                    </div>
                    <div class="card-body">

                        <!-- start form for validation -->
                        <form class="demo-form" data-parsley-validate wire:submit.prevent="save">
                            <div class="form-group">
                                <label>@lang('Hcaptcha Public Key')</label>
                                <input type="text" class="form-control" wire:model="setting.hc_public_key"
                                    value="{{ SETTING['hc_public_key'] }}">
                            </div>
                            <div class="form-group" style="margin-top:10px;">
                                <label>@lang('Hcaptcha Secret Key')</label>
                                <input type="text" class="form-control" wire:model="setting.hc_secret_key"
                                    value="{{ SETTING['hc_secret_key'] }}">
                            </div>
                            <input type="submit" class="btn btn-success" value="@lang('save')" style="margin-top:20px;box-shadow:none;background:#067fda;border-color:#067fda;" />

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
