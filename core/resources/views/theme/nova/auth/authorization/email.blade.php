@extends(SETTING['site_theme'] . 'layouts.app')

@section('title', 'Confirm Account')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('Email Authentication!')
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.verify.email') }}" method="POST" class="login-form">
                        @csrf

                        <div class="form-group">
                            <p class="text-center">@lang('Your Email'): <strong>{{ auth()->user()->email }}</strong>
                            </p>
                        </div>


                        <div class="form-group" >
                            <label >@lang('Verification Code')</label>
                            <input type="text" name="email_verified_code" class="form-control" maxlength="7"
                                id="code">
                        </div>

                        <div class="form-group">
                            <div class="d-grid gap-6">
                                <button type="submit" class="btn btn-primary"
                                    >@lang('Submit')</button>
                            </div>
                        </div>


                        <div class="form-group text-center" >
                            <p >@lang('Please check including your Junk/Spam Folder. if not found, you can') <a
                                    href="{{ route('user.send.verify.code') }}?type=email" class="forget-pass">
                                    @lang('Resend code')</a></p>
                            @if ($errors->has('resend'))
                                <br />
                                <small >{{ $errors->first('resend') }}</small>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-js-notify />
@push('script')
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
@endpush
