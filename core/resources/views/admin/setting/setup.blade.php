@section('title', __('General Settings'))
<div>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">@lang('Manage Website') </h2>
                    </div>
                    <div class="card-body" >
                        <!-- start form for validation -->
                        <form id="demo-form" action="" method="POST" wire:submit.prevent="update()">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Currency')</label>
                                        <input class="form-control" type="text" 
                                            wire:model="set.cur_text" value="{{ $set['cur_text'] }}" />
                                    </div>
                                    <div class="form-group ">
                                        <label>@lang('Currency Symbol') </label>
                                        <input class="form-control" type="text" 
                                            wire:model="set.cur_sym"  value="{{ $set['cur_sym'] }}" />
                                    </div>

                                    <div class="form-group ">
                                        <label>@lang('Currency Rate') </label>
                                        <input class="form-control" type="text" 
                                            wire:model="set.cur_rate"  value="{{ $set['cur_rate'] }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('Referral register\'s bonus amount') </label>
                                        <input class="form-control" type="text"
                                            wire:model="set.reg_ref_bounce"
                                            />
                                    </div>

                                    <div class="form-group">
                                        <label class=""> @lang('Timezone')</label>
                                        <select name="updateTimezone" class="form-control" wire:model="updateTimezone">
                                            @foreach ($timezones as $timezone)
                                                <option value="'{{ @$timezone }}'">
                                                    {{ __($timezone) }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex justify-content-between align-items-center mb-2" wire:ignore>
                                        <label>@lang('User Registration')</label>

                                        <input type="checkbox" wire:model="set.registration" data-value="{{ $set['registration'] }}"/>
                                    </div>

                                    <div class="form-group d-flex justify-content-between align-items-center mb-2" wire:ignore>
                                        <label>@lang('Force SSL')</label>

                                        <input type="checkbox" wire:model="set.force_ssl" data-value="{{ $set['force_ssl'] }}"/>
                                    </div>


                                    <div class="form-group d-flex justify-content-between align-items-center mb-2" wire:ignore>
                                        <label>@lang('Withdraw Status')</label>

                                        <input type="checkbox"  wire:model="set.withdraw_status" data-value="{{ $set['withdraw_status'] }}"/>
                                    </div>
                                    <div class="form-group d-flex justify-content-between align-items-center mb-2" wire:ignore>
                                        <label>@lang('Force Secure Password')</label>

                                        <input type="checkbox" wire:model="set.secure_password" data-value="{{ $set['secure_password'] }}"/>
                                    </div>
                                    <div class="form-group d-flex justify-content-between align-items-center mb-2" wire:ignore>
                                        <label> @lang('Email Verification')</label>

                                        <input type="checkbox" wire:model="set.ev" data-value="{{ $set['ev'] }}"/>
                                    </div>
                                    <div class="form-group d-flex justify-content-between align-items-center mb-2" wire:ignore>
                                        <label>@lang('Email Notification')</label>

                                        <input type="checkbox"  wire:model="set.en" data-value="{{ $set['en'] }}"/>
                                    </div>

                                </div>
                            </div>
                            <input type="submit" class="btn btn-success mt-3" value="@lang('Save')" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-js-notify livewire="true" />
    <x-bootstrap-toggle livewire="true" />
</div>
