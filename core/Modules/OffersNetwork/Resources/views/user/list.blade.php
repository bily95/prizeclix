@extends(SETTING['site_theme'] . 'layouts.app')
@section('title')
   All Offers
@endsection
@section('content')
    <div class="browse_content">
        <div class="d-flex justify-content-between my-3">
            <div class="search">
                <input type="search" class="form-control" placeholder="Search by title" />
            </div>
            <div class="filter">
                <select class="form-control" name="orderBy">
                    <option value="0">Filter By</option>
                    <option value="HightPaying">Hight Paying</option>
                    <option value="MostVisited">Most Popular</option>
                </select>
            </div>
        </div>
        <div class="row" id="offers-container">
            @foreach ($offers as $offer)
                <div class="col-lg-2 col-md-3 col-4">
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
                                onerror="this.src='{{ asset('/asset/static/app/imgs/loading.gif') }}'" height="150px" width="100%"
                                alt="" />
                        </div>
                        <div class="card-footer p-1">
                            <p>{{ Str::limit($offer->name, 15, '.') }}
                                <br>
                                <small class="text-muted">{{ @$offer->provider->name }}</small>
                            </p>
                            <div class="d-flex align-items-center justify-content-between flex-nowrap">
                                <p class="">{{ GENERAL_SETTING['cur_sym'] }}{{ $offer->rewards }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
        <div id="loading-indicator" style="display: none;">
            Loading...
        </div>

        {{-- Offer Details show --}}
        <div class="modal animated zoomIn" id="offerDetailsModal" tabindex="-1" aria-labelledby="offerDetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div id="offerDetailsModalContent"></div>
                </div>
            </div>
        </div>
    </div>
    @include('offersnetwork::user.asset')
@endsection
