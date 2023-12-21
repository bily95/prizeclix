@extends(SETTING['site_theme'] . 'layouts.app')

@section('title', '2FA')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('2FA Authentication!')
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.go2fa.verify') }}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group">
                            <p class="text-center">@lang('Current Time'): {{ \Carbon\Carbon::now() }}</p>
                        </div>
                        <div class="form-group" >
                            <label >@lang('2FA Code')</label>
                            <input type="text" name="code" id="code" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="d-grid gap-6">
                                <button type="submit" class="btn btn-primary"
                                    >@lang('Submit')</button>
                            </div>
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
