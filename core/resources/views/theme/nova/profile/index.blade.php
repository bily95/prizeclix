@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Profile ')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center">
                        <div class="me-2 user-image">
                            <img src="{{ getUserImage() }}" height="120px" width="100%" class="user-profile-img" />
                            @php
                                $color = \App\Models\UserLevelsColor::where('id',$level)->first();
                            @endphp
                            <span class="badge" style="background: {!! $color ? $color->color : '#cccc' !!}">{{ $level }}</span>
                        </div>
                        
                        <div class="">
                            <h5 class="text-capitalize">
                                {{ $user->fullname }}
                                @if ($user->ev)
                                    <i class="fas fa-star text-warning" title="Email Verified"></i>
                                @endif
                            </h5>
                            <p>ID: <span class="badge bg-gradient-danger">{{ $user->token_id }}</span><br>
                                Username: <span class="badge bg-gradient-danger">{{ $user->username }}</span><br>
                                Referred By:
                                @if ($referredBy)
                                    <span class="badge bg-gradient-danger">{{ $referredBy->username }}</span><br>
                                @else
                                    <span class="badge bg-gradient-danger">None</span><br>
                                @endif
                                Joined At: <span
                                    class="badge bg-gradient-danger">{{ showDateTime($user->created_at) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @if (Route::has('coupon.click'))
                        @include('coupon::index')
                    @endif
                </div>
            </div>

        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <hr>
        <li class="nav-item ">
            <a class="nav-link @if (\Route::current()->parameter('tab') == false) active @endif" href="{{ route('user.profile') }}">About</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link @if (\Route::current()->parameter('tab') === 'update') active @endif"
                href="{{ route('user.profile', 'update') }}">Edit Profile</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link @if (\Route::current()->parameter('tab') === 'password') active @endif"
                href="{{ route('user.profile', 'password') }}">Change Password</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link @if (\Route::current()->parameter('tab') === 'twofactor') active @endif"
                href="{{ route('user.profile', 'twofactor') }}">2-FA Authentication</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link @if (\Route::current()->parameter('tab') === 'account') active @endif"
                href="{{ route('user.profile', 'account') }}">Account Setting</a>
        </li>
    </ul>
    <div class="tab-content min-vh-50" id="myTabContent">
        @if (\Route::current()->parameter('tab') == false)
            @include(SETTING['site_theme'] . 'profile.partials.about')
        @endif
        @if (\Route::current()->parameter('tab') === 'update')
            @include(SETTING['site_theme'] . 'profile.partials.setting')
        @endif
        @if (\Route::current()->parameter('tab') === 'password')
            @include(SETTING['site_theme'] . 'profile.partials.password')
        @endif
        @if (\Route::current()->parameter('tab') === 'twofactor')
            @include(SETTING['site_theme'] . 'profile.partials.twofactor')
        @endif
        @if (\Route::current()->parameter('tab') === 'account')
            @include(SETTING['site_theme'] . 'profile.partials.account')
        @endif
    </div>

    <!-- Delete Modal -->
    @include(SETTING['site_theme'] . 'profile.partials.modal')
@endsection
<x-select2 search="true" />
<x-js-notify />
<x-bootstrap-toggle />
@push('style')
    <style>
        .me-2.user-image {
            position: relative;
        }

        .me-2.user-image span {
            position: absolute;
            left: 0;
            font-size: 1rem;
        }
    </style>
@endpush
