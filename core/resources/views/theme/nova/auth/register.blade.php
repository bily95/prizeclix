@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', trans('Register'))
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('Start for free!')
                    </h3>
                </div>
                <div class="card-body">
                    @if (SETTING['enable_google_auth'])
                        <a href="{{ url('auth/google') }}">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button"><i class="fab fa-google"></i></button>
                            </div>
                        </a>
                    @endif
                    <form class="account-form w-100" action="{{ route('user.register.complete') }}" method="POST">
                        @csrf
                        @if (session()->get('reference') != null)
                            <div class="form-group">
                                <label for="referenceBy">@lang('Reference By') <sup class="text-danger">*</sup></label>
                                <input type="text" name="referBy" id="referenceBy" class="form-control"
                                    value="{{ session()->get('reference') }}" readonly>
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="username">{{ __('Username') }}</label>
                                        <input id="username" type="text" class="form-control checkUser" name="username"
                                            value="{{ old('username') }}" tabindex="1" required
                                            placeholder="@lang('Username')">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">@lang('E-Mail Address')</label>
                                        <input id="email" type="email" tabindex="2" class="form-control checkUser"
                                            name="email" value="{{ old('email') }}" required
                                            placeholder="@lang('E-Mail Address')">
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group hover-input-popup">
                                        <label for="password">@lang('Password')</label>
                                        <input id="password" type="password" tabindex="3" class="form-control"
                                            name="password" required placeholder="@lang('Password')">
                                        @if (GENERAL_SETTING['secure_password'])
                                            <div class="input-popup">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p class="error lower">@lang('1 small letter minimum')</p>
                                                        <p class="error capital">@lang('1 capital letter minimum')</p>
                                                        <p class="error number">@lang('1 number minimum')</p>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <p class="error special">@lang('1 special character minimum')</p>
                                                        <p class="error minimum">@lang('6 character password')</p>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                        @error('password')
                                            <span class="text-danger">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password-confirm">@lang('Confirm Password')</label>
                                        <input id="password-confirm" tabindex="4" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="@lang('Confirm Password')">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        @if ($enabledCaptcha)
                                            {!! $captcha !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="checkbox" required class="custom-form-input" data-on="yes" data-off="no" />
                                        <label class="custom-form-label">@lang('Signing up you agree to the ')
                                            <a href="{{ route('tos') }}">@lang('Terms of Service')</a> and
                                            <a href="{{ route('policy') }}">@lang('Privacy Policy')</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid gap-6">
                                    <button type="submit" class="btn btn-primary mt-3">@lang('Register
                                                                                                                                                                                                                                                                                                                Now')</button>
                                    <div class="col-12 text-center">
                                        <p class="text-center mt-3"><span class="">@lang('Have an account?')</span> <a
                                                href="{{ route('user.login') }}" class="text-base">@lang('Login here')</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">
                        @lang('Warning')</h5>

                </div>
                <div class="modal-body">
                    <h6>@lang('You already have an account please Sign in ')</h6>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('user.login') }}" class="btn btn-primary">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>

    <x-js-notify />
    <x-bootstrap-toggle />
@endsection
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
            z-index: 99;
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

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response['data'] && response['type'] == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response['data'] != null) {
                        $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                    } else {
                        $(`.${response['type']}Exist`).text('');
                    }
                });
            });

        })(jQuery);
    </script>
@endpush
