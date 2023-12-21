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
                <img data-src="{{ $offer->image }}" src="{{ $offer->image }}" class="lazyload"
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
