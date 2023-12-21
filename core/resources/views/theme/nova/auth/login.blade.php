@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', trans('Login'))
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('Welcome Back!')
                    </h3>
                </div>
                <div class="card-body">
                    @if (SETTING['enable_google_auth'])
                        <a href="{{ url('auth/google') }}">
                            <div class="d-grid gap-6">

                                <button class="btn btn-primary" type="button"
                                    ><i class="fab fa-google"></i> </button>
                            </div>
                        </a>
                    @endif

                    <form class="account-form" method="POST" action="{{ route('user.login.complete') }}"
                        onsubmit="return submitUserForm();">
                        @csrf
                        <div class="form-group">
                            <label >@lang('Email') <sup class="text-danger">*</sup></label>
                            <input type="text" name="username" value="{{ old('username') }}"
                                placeholder="@lang('Email')" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label >{{ __('Password') }} <sup class="text-danger">*</sup></label>
                            <input id="password" type="password" class="form-control" placeholder="@lang('Enter your password')"
                                name="password" required>
                        </div>

                        <div class="form-group">
                            @if ($enabledCaptcha)
                                {!! $captcha !!}
                            @endif
                        </div>


                        <div class="form-group text-end">
                            <a href="{{ route('user.password.request') }}" class="text-drak"
                                >@lang('Forgot Password?')</a>
                        </div>

                        <div class="d-grid gap-6">
                            <button type="submit" class="btn btn-primary"
                                >@lang('Login Now')</button>
                        </div>
                        <p class="text-center mt-3"><span class="">@lang('New to') {{ SETTING['siteName'] }}?</span>
                            <a href="{{ route('user.register') }}"
                                class="text-base">@lang('Register here')</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-js-notify />