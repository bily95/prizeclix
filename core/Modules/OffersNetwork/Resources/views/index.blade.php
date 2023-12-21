<div wire:ignore>
    @if (count($bannerOffers) > 0)
        <div class="top_slider banner_slider banner-slider">
            @foreach ($bannerOffers as $bannerOffer)
                <div class="card banner-card p-0 round ">
                    <div class="banner-image">
                        <a href="#!" data-offer-id="{{ $bannerOffer->id }}" class="offerClick">
                            <i class="fas fa-play-circle"></i>
                        </a>
                        <img data-src="{{ $bannerOffer->image }}" src="{{ $bannerOffer->image }}" class="lazyload"
                            onerror="this.src='{{ asset('/asset/static/app/imgs/loading.gif') }}'" height="150px"
                            width="100%" alt="" />
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <p>{{ Str::limit($bannerOffer->name, 10, '.') }}
                            <br>
                            <small class="text-muted">{{ @$bannerOffer->provider->name }}</small>
                        </p>
                        <p>{{ $bannerOffer->rewards }}{{ GENERAL_SETTING['cur_sym'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @guest
        <div class="my-5 text-center" id="hero_section">
            <h1 class="info">Get Paid For</h1>
            <p class="mb-3">Testing Apps, Playing games, and going thinks you are already doing</p>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-block d-md-flex flex-nowrap justify-content-around align-items-center">
                                <div class="column py-3 py-md-0">
                                    <p class="info"><i class="fas fa-coins"></i> {{ showAmount($getCompletedOffers, 0) }}
                                    </p>
                                    <p>Total offers completed</p>
                                </div>
                                <div class="column py-3 py-md-0">
                                    <p class="info">$
                                        {{ showAmount($averageDailyEarnings / GENERAL_SETTING['cur_rate']) }}
                                    </p>
                                    <h5>Average Earnings Yesterday</h5>
                                </div>
                                <div class="column py-3 py-md-0">
                                    <p class="info">$ {{ showAmount($getTotalPaid / GENERAL_SETTING['cur_rate']) }}</p>
                                    <p>Total Earnings USD by users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="my-3 text-lg">
                over <span class="info">+2250</span> Available Offers for you
                <br> Earn up to <span class="info">$25</span> per offer
            </p>
            <div class="cat my-2">
                <a href="{{ route('user.register') }}" class="btn btn-primary py-2 px-5">Create An Account</a>
            </div>
        </div>
    @endguest

    @foreach ($offersWithCategories as $category)
        @if (count($category['offers']) > 0)
            <h5 class="float-start text-capitalize">{{ $category['name'] }} Offers</h5>
            @if (count($category['offers']) > 8)
                <a href="{{ route('user.offer-network.browse', [$category['id'], $category['name']]) }}"
                    class="float-end nav-link">See All</a>
            @endif
            <div class="clearfix"></div>
            <div class="home_slider banner-slider">
                @foreach ($category['offers'] as $offer)
                    <div class="card banner-card p-0 round ">
                        <div class="banner-image">
                            <div class="offers-devices">
                                @php
                                    $devices = $offer->device;
                                    //dump($devices);
                                @endphp
                                @if (Str::contains($devices, 'windows') || Str::contains($devices, 'desktop'))
                                    <i class="fab fa-windows" title="windows"></i>
                                @endif
                                @if (Str::contains($devices, 'android'))
                                    <i class="fab fa-android" title="android"></i>
                                @endif
                                @if (Str::contains($devices, 'ipad'))
                                    <i class="fas fa-tablet-screen-button" title="ipad"></i>
                                @endif
                                @if (Str::contains($devices, 'iphone'))
                                    <i class="fab fa-apple" title="iphone"></i>
                                @endif
                                @if (Str::contains($devices, 'mac'))
                                    <i class="fas fa-desktop" title="mac"></i>
                                @endif
                            </div>
                            <a href="#!" data-offer-id="{{ $offer->id }}" class="offerClick">
                                <i class="fas fa-play-circle"></i>
                            </a>
                            <img  data-src="{{ $offer->image }}" src="{{ $offer->image }}" class="lazyload"
                                onerror="this.src='{{ asset('/asset/static/app/imgs/loading.gif') }}'" height="150px"
                                width="100%" alt="" />
                        </div>
                        <div class="card-footer p-1">
                            <p>{{ Str::limit($offer->name, 15, '.') }}
                                <br>
                                <small class="text-muted">{{ @$offer->provider->name }}</small>
                            </p>
                            <div class="d-flex align-items-center justify-content-between flex-nowrap">
                                <p class="">{{ GENERAL_SETTING['cur_sym'] }}{{ $offer->rewards }}</p>
                                <p class="bg-dark py-0 px-1 text-small rounded overflow-hidden">
                                    {{ Str::limit($category['name'], 3, '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach

    {{-- Offer Details show --}}
    <div class="modal animated zoomIn" id="offerDetailsModal" tabindex="-1" aria-labelledby="offerDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="offerDetailsModalContent"></div>
            </div>
        </div>
    </div>
    @include('offersnetwork::user.asset')
</div>
