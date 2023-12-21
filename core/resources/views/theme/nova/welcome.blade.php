@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Welcome')
@section('content')
<div>
    @include('offersnetwork::index')
    @include(SETTING['site_theme'] . 'offers.index', ['data' => $data])
   
    </div>
@endsection

@push('script')
<x-js-notify livewire="true" />
<script>
    function loadUserOffers($provider)
    {
        $.ajax({
            type: "GET",
            dataType: "Json",
            url: "{{ url('api/offers-network/load') }}/" + $provider,
            success: function(res) {
              console.log($provider + ": " + res);  
            },
            error:function(error)
            {
                console.log($provider + ": " + error);
            }
        })
    }
    loadUserOffers('wannads');
    loadUserOffers('kiwiwall');
    loadUserOffers('cpx-research');
    loadUserOffers('monlix');
</script>
@endpush
