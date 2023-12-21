<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card  mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">group</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Users</p>
                            <h4 class="mb-0">{{ \App\Models\User::count() }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="{{ route('moder.users.all') }}"
                            class="mb-0 d-flex align-items-center justify-content-center"><span class="text-sm">See
                                All</span>
                            <i class="material-icons opacity-10">east</i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-12">

                <div class="card  mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">redeem</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Offers</p>
                            <h4 class="mb-0">{{ $data['totalOffers'] }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="{{ route('moder.offer.analysis') }}"
                            class="mb-0 d-flex align-items-center justify-content-center"><span class="text-sm">See
                                All</span>
                            <i class="material-icons opacity-10">east</i>
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6">
                <div class="card  mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">redeem</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Pending Offers</p>
                            <h4 class="mb-0">{{ $data['pendingOffers'] }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="{{ route('moder.offer.analysis') }}"
                            class="mb-0 d-flex align-items-center justify-content-center"><span class="text-sm">See
                                All</span>
                            <i class="material-icons opacity-10">east</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">

                <div class="card  mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">redeem</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Current Online</p>
                            <h4 class="mb-0">{{ $data['currentOnline'] }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="{{ route('moder.users.all') }}"
                            class="mb-0 d-flex align-items-center justify-content-center"><span class="text-sm">See
                                All</span>
                            <i class="material-icons opacity-10">east</i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-12">
                <div class="card  mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">redeem</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Earnings</p>
                            <h4 class="mb-0">{{ $data['offersEarned'] }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="{{ route('moder.users.all') }}"
                            class="mb-0 d-flex align-items-center justify-content-center d-none"><span
                                class="text-sm">See All</span>
                            <i class="material-icons opacity-10">east</i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-12">
                <div class="card  mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">redeem</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Today Withdrawals</p>
                            <h4 class="mb-0">{{ $data['todayWithdawls'] }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <a href="{{ route('moder.users.all') }}"
                            class="mb-0 d-flex align-items-center justify-content-center d-none"><span
                                class="text-sm">See All</span>
                            <i class="material-icons opacity-10">east</i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
 
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $data['userChart']->options['chart_title'] }}
                </h3>
            </div>
            <div class="card-body">
                {!! $data['userChart']->renderHtml() !!}
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Users Traffic
                </h3>
            </div>
            <div class="card-body p-0">
                <div id="map" style="height:400px"></div>
            </div>
        </div>
    </div>

</div>

{{-- cron model --}}
<div class="modal fade" id="cronJobStatus" tabindex="-1" aria-labelledby="cronJobStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            The cronjobs are not set yet!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close Now</button>
          <a href="{{ route('moder.manage-site.cron') }}" class="btn btn-primary">Go to CronJobs</a>
        </div>
      </div>
    </div>
  </div>
@push('style')
    <link rel="stylesheet" href="{{ asset('/asset/static/jvectormap') }}/jquery-jvectormap-2.0.5.css" />
@endpush

@push('script')
    {!! $data['userChart']->renderChartJsLibrary() !!}
    {!! $data['userChart']->renderJs() !!}

    <script src="{{ asset('/asset/static/jvectormap') }}/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="{{ asset('/asset/static/jvectormap') }}/jquery-jvectormap-world-mill-en.js"></script>
    <script>
        $(function() {

            $.getJSON('/admin/api/users/counrites/count').then(function(data) {
                $('#map').vectorMap({
                    map: 'world_mill_en',
                    series: {
                        regions: [{
                            values: data,
                            scale: ['#C8EEFF', '#0071A4'],
                            normalizeFunction: 'polynomial'
                        }]
                    },
                    onRegionTipShow: function(e, el, code) {
                        var users = data[code];
                        users = users == undefined ? 0 : users
                        el.html(el.html() + ':' + users);
                    }
                });
            });
        });
    </script>

    @if (!$data['cronJobStatus'])
        <script>
            $(document).ready(function(){
                $('#cronJobStatus').modal('show');
            });
        </script>
    @endif

@endpush

</div>


