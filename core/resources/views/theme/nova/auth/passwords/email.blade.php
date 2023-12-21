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
                    <form class="account-form" method="POST" action="{{ route('user.password.email') }}">
                        @csrf
                        <div class="panel">
                            <div class="form-group">
                                <label >@lang('Select One')</label>
                                <select class="form-control" name="type">
                                    <option value="email" >@lang('E-Mail Address')</option>
                                    <option value="username" >@lang('Username')</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="my_value" ></label>
                                <input type="text" class="form-control @error('value') is-invalid @enderror"
                                    name="value" value="{{ old('value') }}" required autofocus="off">
                            </div>

                            <button type="submit" class="btn btn-secondary w-100"
                                >@lang('Send Password Code')</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-js-notify />
    <script>
        (function($) {
            "use strict";

            myVal();
            $('select[name=type]').on('change', function() {
                myVal();
            });

            function myVal() {
                $('.my_value').text($('select[name=type] :selected').text());
            }
        })(jQuery)
    </script>
@endsection
