<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            Profile Editing
        </h5>

        <form action="{{ route('user.profile.setting.update') }}" id="profile-settings-form" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="p-2">
                <div class="d-flex mb-1 align-items-center justify-content-center">
                    <div class="me-1">
                        <img src="{{ getUserImage() }}" height="50px" width="50px" />
                    </div>
                    @if (empty($user->google_id))
                    <div class="w-50 w-md-100">
                        <input type="file" class="form-control" name="image" />
                    </div>
                    @endif
                </div>
                <div class="py-2">
                    <div class="row">
                        <div class="col-md-6 my-1">
                            <x-bs::input type="text" name="firstname" value="{{ $user->firstname }}"
                                label="First Name" />
                        </div>
                        <div class="col-md-6 my-1">
                            <x-bs::input type="text" name="lastname" value="{{ $user->lastname }}"
                                label="Last Name" />
                        </div>
                        <div class="col-md-6 my-1">
                            <x-bs::input type="text" name="mobile" value="{{ $user->mobile }}"
                                label="Mobile Number" />
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6 my-1">
                            <x-bs::input type="text" name="address[address1]" value="{{ @$userAddress['address1'] }}"
                                label="Address" />
                        </div>
                        <div class="col-md-6 my-1">
                            <x-bs::input type="text" name="address[state]" value="{{ @$userAddress['state'] }}"
                                label="Region" />
                        </div>
                        <div class="col-md-6 my-1">
                            <x-bs::input type="text" name="address[city]" value="{{ @$userAddress['city'] }}"
                                label="City" />
                        </div>
                        <div class="col-md-6 my-1">
                            <x-bs::input type="text" name="address[zip]" value="{{ @$userAddress['zip'] }}"
                                label="Zip/Postal Code" />
                        </div>
                        <div class="col-md-6 my-1">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select name="address[country]" id="country" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach (getCountries() as $country)
                                        <option value="{{ $country }}"
                                            @if ($country == @$userAddress['country']) selected @endif>
                                            {{ __($country) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <x-bs::button type="submit" class="my-2 custom-profile-setting-btn" :label="__('Update')"
                        icon="share" />
                </div>
            </div>
        </form>
    </div>
</div>
