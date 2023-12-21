<div class="modal-header" style="background-image:url('{{ $offer->image }}')">
    <div class="modal-header-content">
        <div class="offer-header d-flex align-items-center">
            <img data-src="{{ $offer->image }}" src="{{ $offer->image }}" class="lazyload rounded-3 me-2"
                onerror="this.src='{{ asset('/asset/uploads/offerwalls/custom/cpx.png') }}'" height="100px" width="100px"
                alt="" />
            <div class="offer-header-info">
                <h5 class="modal-title" id="exampleModalLabel">{{ $offer->name }}</h5>
                <div class="d-flex">
                    {{ GENERAL_SETTING['cur_sym'] }} {!! intval($offer->rewards) == 0 ? '<i class="fas fa-infinity"></i>' : $offer->rewards !!}
                </div>
                <div class="d-flex device-icons my-2">
                    @foreach (explode('-',$offer->device) as $device)
                        {!! \Modules\OffersNetwork\Http\Controllers\OffersNetworkController::displayOfferDevice($device) !!}
                    @endforeach
                </div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
</div>
<div class="modal-body">
    <h3>About</h3>
    <p>{!! str_replace('.', '.<br/>', strip_tags($offer->description)) !!}</p>
    <hr />

    <h6>Categories</h6>
    <div class="d-flex">
        @foreach (explode('-',$offer->category) as $cate)
            <span class="me-1 bg-info py-0 px-2 rounded-3">{{ $cate }}</span>
        @endforeach
    </div>

    <hr />


    <div class="my-2 d-flex">
        <h6>Provider</h6>: <p>{{ @$offer->provider->name }}</p>
    </div>

</div>
<div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <a href="{{ auth()->check() ? route('user.offer-network.click', $offer->id) : route('user.login') }}"
        @if (auth()->check()) target="_blank" @endif class="btn btn-primary">Start</a>
</div>
