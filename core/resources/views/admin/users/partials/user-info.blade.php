<form action="{{ route('moder.users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group ">
                <label class="">@lang('First Name')<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="firstname" value="{{ $user->firstname }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-control-label  font-weight-bold">@lang('Last Name') <span
                        class="text-danger">*</span></label>
                <input class="form-control" type="text" name="lastname" value="{{ $user->lastname }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group ">
                <label class="">@lang('Email') <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}">
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-6">
            <div class="form-group ">
                <label class="">@lang('Address 1') </label>
                <input class="form-control" type="text" name="address[address1]"
                    value="{{ @$userAddress['address1'] }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group ">
                <label class="">@lang('Address 2') </label>
                <input class="form-control" type="text" name="address[address2]"
                    value="{{ @$userAddress['address2'] }}">
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="form-group">
                <label class="">@lang('City') </label>
                <input class="form-control" type="text" name="address[city]" value="{{ @$userAddress['city'] }}">
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="form-group ">
                <label class="">@lang('State') </label>
                <input class="form-control" type="text" name="address[state]" value="{{ @$userAddress['state'] }}">
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="form-group ">
                <label class="">@lang('Zip/Postal') </label>
                <input class="form-control" type="text" name="address[zip]" value="{{ @$userAddress['zip'] }}">
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="form-group ">
                <label class="">@lang('Country') </label>
                <select name="address[country]" class="form-control">
                    @foreach ($countries as $country)
                        <option value="{{ $country }}" @if ($country == @$userAddress['country']) selected @endif>
                            {{ __($country) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="form-group d-flex align-items-center justify-content-between">
            <label>@lang('User Ref bonus on register') </label>
            <input type="checkbox" name="ref_bounce" @if ($user->ref_bounce) checked @endif>
        </div>
        <div class="form-group d-flex align-items-center justify-content-between">
            <label>@lang('User Status') </label>
            <input type="checkbox" name="status" @if ($user->status) checked @endif>
        </div>

        <div class="form-group d-flex align-items-center justify-content-between">
            <label>@lang('Email Verification') </label>
            <input type="checkbox" name="ev" @if ($user->ev) checked @endif>

        </div>

        <div class="form-group d-flex align-items-center justify-content-between">
            <label>@lang('2FA Status') </label>
            <input type="checkbox" name="ts" @if ($user->ts) checked @endif>
        </div>

        <div class="form-group d-flex align-items-center justify-content-between">
            <label>@lang('2FA Verification') </label>
            <input type="checkbox" name="tv" @if ($user->tv) checked @endif>
        </div>

        <div class="form-group d-flex align-items-center justify-content-between">
            <label>@lang('User Verification') </label>
            <input type="checkbox" name="active_status_by_admin" @if ($user->active_status_by_admin == 1) checked @endif>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block my-1 w-100">@lang('Save Changes')
                </button>
            </div>
        </div>
    </div>
</form>
