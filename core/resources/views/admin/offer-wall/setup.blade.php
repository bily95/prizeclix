<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 style="font-size:22px;margin-top:5px;">@lang('Anti-fraud System')</h2>

            </div>
            <!-- start form for validation -->
            <form id="demo-form" wire:submit.prevent="save">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="my-2 d-flex justify-content-between w-100" wire:ignore>
                                <label for="single_account_per_ip">Single account per ip</label>
                                <input type="checkbox" model="name.single_account_per_ip" data-value="{{ SETTING['single_account_per_ip'] }}"/>
                            </div>

                            <div class="my-2 d-flex justify-content-between w-100" wire:ignore>
                                <label for="detect_using_vpn">Block VPN Access</label>
                                <input type="checkbox" model="name.detect_using_vpn"
                                    :title="__('Dont let users using VPN, bots, bad IPs')" data-value="{{ SETTING['detect_using_vpn'] }}"/>
                            </div>

                            <div class="my-2 d-flex justify-content-between w-100" wire:ignore>
                                <label for="auto_ban_multiple_accounts">Auto ban multiple accounts</label>
                                <input type="checkbox" model="name.auto_ban_multiple_accounts"
                                    :title="__('If users try to create more than account will be banned')" data-value="{{ SETTING['auto_ban_multiple_accounts'] }}"/>
                            </div>

                            <div class="my-2 d-flex justify-content-between w-100" wire:ignore>
                                <label for="auto_ban_using_vpn">Auto ban users who use VPS</label>
                                <input type="checkbox" model="name.auto_ban_using_vpn"
                                    :title="__('If users try to use VPN will be banned')" data-value="{{ SETTING['auto_ban_using_vpn'] }}"/>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="my-2 d-flex justify-content-between w-100" wire:ignore>
                                <label for="detect_adblock">Detect using Adbloks</label>
                                <input type="checkbox" model="name.detect_adblock"
                                    :title="__('Dont let users use adblock extensions and softwares ')"  data-value="{{ SETTING['detect_adblock'] }}"/>
                            </div>

                            <x-bs::input type="text" model="name.proxycheck_io_api" :label="__('Your Proxycheck.io Api Key')" />

                        </div>
                    </div>
                    <br>
                    <x-bs::textarea model="name.blocked_country" :label="__('Block these countries from access to the Offers ')" :placeholder="__('USA, UK')"
                        :title="__(
                            'use country code like USA, UK, .. and celebrate them by comma ,leave it blank to undefined',
                        )" />
                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
    <x-js-notify livewire="true"/>
    <x-bootstrap-toggle livewire="true" />
</div>
