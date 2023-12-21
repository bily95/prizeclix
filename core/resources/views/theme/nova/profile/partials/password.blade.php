<div class="card ">
    <div class="card-body">
        <h5 class="card-title">Change Password</h5>
        <form action="{{ route('user.change.password.submit') }}" method="post" class="register">
            @csrf
            <div class="form-group">
                <label for="password">@lang('Current Password')</label>
                <input id="password" type="password" class="form-control" name="current_password" required
                    autocomplete="current-password" placeholder="@lang('Current Password')">
            </div>
            <div class="form-group hover-input-popup">
                <label for="password">@lang('Password')</label>
                <input id="password" type="password" class="form-control" name="password" required
                    autocomplete="current-password" placeholder="@lang('Password')">
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
                <label for="confirm_password">@lang('Confirm Password')</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                    required autocomplete="current-password" placeholder="@lang('Confirm Password')">
            </div>
            <div class="form-group text-center">
                <input type="submit" class="mt-4 btn btn-primary" value="@lang('Update')">
            </div>
        </form>
    </div>
</div>

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
    <script src="{{ asset('asset/static/app/js/secure_password.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            @if (GENERAL_SETTING['secure_password'])
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });
            @endif
        })(jQuery);
    </script>
@endpush
