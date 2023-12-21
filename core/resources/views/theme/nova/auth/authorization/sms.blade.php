@extends(SETTING['site_theme'] . 'layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('SMS Authentication!')
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.verify.sms') }}" method="POST" class="login-form">
                        @csrf

                        <div class="form-group">
                            <p class="text-center">@lang('Your Mobile Number'):
                                <strong>{{ auth()->user()->mobile }}</strong>
                            </p>
                        </div>


                        <div class="form-group">
                            <label>@lang('Verification Code')</label>
                            <input type="text" name="sms_verified_code" id="code" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="btn-area text-center">
                                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <p>@lang('If you don\'t get any code'), <a href="{{ route('user.send.verify.code') }}?type=phone"
                                    class="forget-pass">
                                    @lang('Try again')</a></p>
                            @if ($errors->has('resend'))
                                <br />
                                <small class="text-danger">{{ $errors->first('resend') }}</small>
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
