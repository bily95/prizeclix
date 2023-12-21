@foreach ($cardsInfo as $info)
    <div class="col-lg-4 col-sm-6">
        <div class="card m-3">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-sm icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">equalizer</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">{{ $info['text'] }}</p>
                    <h4 class="mb-0">{{ $info['value'] }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <a class="mb-0" href="{{ $info['link'] }}" target="_blank">
                  see details <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach
