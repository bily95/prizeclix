@section('title', __('Google Login Setup '))
@section('page-title', __('Site Authentication Setting'))

<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">@lang('Google Login Setup') </h5>
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" wire:ignore>
                            <input type="checkbox" id="setting.enable_google_auth"
                                wire:model="setting.enable_google_auth"
                                data-value="{{ SETTING['enable_google_auth'] }}" />
                            <label for="setting.enable_google_auth" class="form-check-inputform-check-label">@lang('Enable Google Authentication')</label>
                        </div>
                        <div class="form-group">
                            <label for="google_client_id">Google Client ID</label>
                            <input type="text" class="form-control" wire:model="setting.google_client_id"
                                value="{{ SETTING['google_client_id'] }}" />
                        </div>
                        <div class="form-group">
                            <label for="google_secret_key">Google secret key</label>
                            <input type="text" class="form-control" wire:model="setting.google_secret_key"
                                value="{{ SETTING['google_secret_key'] }}" />
                        </div>
                        <div class="form-group">
                            <label for="google_secret_key">Google callback URL</label>
                            <input type="text" class="form-control disabled" readonly
                                value="{{ url('auth/google/callback') }}" />
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>

                <div class="my-3 text-center">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<x-js-notify livewire="true" />
<x-bootstrap-toggle livewire="true" />
