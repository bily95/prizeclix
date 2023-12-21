@extends(SETTING['site_theme'] . 'layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('One more step!')
                    </h3>
                </div>
                <div class="card-body">
                    <form class="account-form" method="POST" action="{{ route('user.password.verify.code') }}">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="panel">
                            <div class="form-group">
                                <label>@lang('Verification Code')</label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary w-100"
                                >@lang('Verify Code')
                                <i class="fas fa-sign-in-alt"></i>
                            </button>
                            <p class="text-center mt-3"><span class="text-white"
                                    >@lang('Please check including your Junk/Spam Folder.
                                                            if not found, you can')</span>
                                <a href="{{ route('user.password.request') }}"
                                    >@lang('Try to send again')</a>
                            </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-js-notify />
    <script>
        (function($) {
            "use strict";
            $('#code').on('input change', function() {
                var xx = document.getElementById('code').value;
                $(this).val(function(index, value) {
                    value = value.substr(0, 7);
                    return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
                });
            });
        })(jQuery)
    </script>
@endsection
