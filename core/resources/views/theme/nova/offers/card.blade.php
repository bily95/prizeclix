@php
    $valid = auth()->check() && ($oneOffer->user_level > $user->profile->level);
@endphp

<div class="">
    <div class="offerwallsposition custom-offerwall-style2">
        <div class="innerwall {{ $oneOffer->is_available == 0 ? 'unavailable' : '' }}">
            <a href="{{ $valid ? $offerURL : '#!' }}"
                class="{{ $valid ? 'offer-url' : '' }}"
                title="{{ $oneOffer->name }}">
                <div class="innerwall2"
                    style="background: rgb(37, 43, 49);
                    background: linear-gradient(0deg,  rgb(42 46 63) 4%, {{ $oneOffer->bgcolor }} 45%);">
                    <img src="{{ asset('asset/uploads/offerwalls/' . $oneOffer->image) }}"
                        onerror="this.src='{{ asset('/asset/static/app/imgs/loading.gif') }}'" />
                    @if ($valid)
                        <div class="lock">
                            <span title="Require level {{ $oneOffer->user_level }}">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    @endif
                    <div>
                        <p class="offerwall-name">{{ $oneOffer->name }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
