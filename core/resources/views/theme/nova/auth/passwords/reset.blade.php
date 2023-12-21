@extends(SETTING['site_theme'] . 'layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('Recover your password!')
                    </h3>
                </div>
                <div class="card-body">
                    <form class="account-form" method="POST" action="{{ route('user.password.update') }}">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="panel">
                            <div class="account-thumb-area text-center">
                                <h3 class="title">@lang('Reset Password')</h3>
                            </div>

                            <div class="form-group hover-input-popup">
                                <label for="password" >@lang('Password')</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if (GENERAL_SETTING['secure_password'])
                                    <div class="input-popup">
                                        <p class="error lower">@lang('1 small letter minimum')</p>
                                        <p class="error capital">@lang('1 capital letter minimum')</p>
                                        <p class="error number">@lang('1 number minimum')</p>
                                        <p class="error special">@lang('1 special character minimum')</p>
                                        <p class="error minimum">@lang('6 character password')</p>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" >@lang('Confirm Password')</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary w-100"
                                >@lang('Reset Password')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-js-notify />
@push('style') 
<style>
.form-group.hover-input-popup {
    position: relative;
}
.form-group.hover-input-popup .input-popup {
    position: absolute;
    top: 70px;
    left: 28px;
    background: #383d52;
    color: #bcb7be;
    padding: 5px;
    border-radius: 5px;
    display: none;
}

.form-group.hover-input-popup:hover .input-popup {
    display: block;
}

.input-popup p {
    padding: 2px 0;
    margin: 0px;
}
.input-popup p.error {
    color: coral;
}
.input-popup p.success {
    color: rgb(4, 191, 197);
}
</style>
@endpush
@push('script')
    @if (GENERAL_SETTING['secure_password'])
        <script src="{{ asset('asset/static/app/js/secure_password.js') }}"></script>
    @endif
    <script>
        "use strict";

        (function($) {

            @if (GENERAL_SETTING['secure_password'])
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });
            @endif    
        })(jQuery);
    </script>
@endpush