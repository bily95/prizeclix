@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Rewards History')
@section('content')
    <div class="card">
        <div class="card-bod">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel text-center bg-primary">
                        <div class="panel-body p-1 d-flex align-items-center justify-content-around">
                            <div class="icon">
                                <i class="fas fa-chart-pie fa-2x"></i>
                            </div>
                            <div class="text">
                                <p class="p-1 m-0">Total Earnings</p>
                                <p class="p-0 m-0">{{ showAmount($totalEarnings, 0) }} {{ GENERAL_SETTING['cur_sym'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel text-center bg-success">
                        <div class="panel-body p-1 d-flex align-items-center justify-content-around">
                            <div class="icon">
                                <i class="fas fa-chart-pie fa-2x"></i>
                            </div>
                            <div class="text">
                                <p class="p-1 m-0">Total Balance</p>
                                <p class="p-0 m-0">{{ Str::limit(showAmount(auth()->user()->balance, 0), 20) }}{{ GENERAL_SETTING['cur_sym'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel text-center bg-secondary">
                        <div class="panel-body p-1 d-flex align-items-center justify-content-around">
                            <div class="icon">
                                <i class="fas fa-chart-pie fa-2x"></i>
                            </div>
                            <div class="text">
                                <p class="p-1 m-0">On Holding</p>
                                <p class="p-0 m-0">{{ showAmount($holdingBalance, 0) }}{{ GENERAL_SETTING['cur_sym'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group">
                <a href="#!" class="completed_offers mx-1 btn btn-primary">Offers</a>
                <a href="#!" class="leaderboard mx-1 btn btn-primary">Leaderboard</a>
                <a href="#!" class="daily_tasks mx-1 btn btn-primary">Daily Tasks</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card offers-holder">
                <div class="card-header">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover offer_table">
                                <thead>
                                    <tr>
                                        <th class="paraff">@lang('OfferName')</th>
                                        <th class="paraff">@lang('Provider')</th>
                                        <th class="paraff">@lang('Status')</th>
                                        <th class="paraff">@lang('Amount')</th>
                                        <th class="paraff">@lang('Date')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card extra-holder">
                <div class="card-header">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover extra-table">
                                <thead>
                                    <tr>
                                        <th class="paraff">@lang('Amount')</th>
                                        <th class="paraff">@lang('Title')</th>
                                        <th class="paraff">@lang('Date')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush
@push('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        var $offerTable = $("table.table.offer_table");
        var $extraTable = $("table.table.extra-table");

        function initializeDataTable(dataUrl, columns, table = 'offer') {
            $offerTable.DataTable().clear().destroy();
            $extraTable.DataTable().clear().destroy();

            if (table == 'offer') {
                new DataTable($offerTable, {
                    ajax: dataUrl,
                    columns: columns,
                });
            } else {
                new DataTable($extraTable, {
                    ajax: dataUrl,
                    columns: columns,
                });
            }
        }
        $(document).ready(function() {
            initializeDataTable('{{ route('user.offer.reports') }}?fetchOffers=1', [{
                    "data": "offer_name"
                },
                {
                    "data": "offers.name"
                },
                {
                    "data": "status"
                },
                {
                    "data": "amount"
                },
                {
                    "data": "created_at"
                },
            ]);
            $('.extra-holder').hide();

            $('.completed_offers').click(function(e) {
                e.preventDefault();
                initializeDataTable('{{ route('user.offer.reports') }}?fetchOffers=1', [{
                        "data": "offer_name"
                    },
                    {
                        "data": "offers.name"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "amount"
                    },
                    {
                        "data": "created_at"
                    },
                ]);
                $('.extra-holder').hide();
                $('.offers-holder').show();
            });

            $('.leaderboard').click(function(e) {
                e.preventDefault();
                $('.daily_tasks_type').hide();
                initializeDataTable('{{ route('user.offer.reports') }}?fetchLeader=1', [{
                        "data": "reward"
                    },
                    {
                        "data":"type"
                    },
                    {
                        "data": "created_at"
                    },
                ], 'extra');
                $('.extra-holder').show();
                $('.offers-holder').hide();
            });

            $('.daily_tasks').click(function(e) {
                e.preventDefault();
                $('.daily_tasks_type').show();
                initializeDataTable('{{ route('user.offer.reports') }}?fetchDailyBox=1', [{
                        "data": "reward"
                    },
                    {
                        "data": "task.title"
                    },
                    {
                        "data": "created_at"
                    },
                ], 'extra');
                $('.extra-holder').show();
                $('.offers-holder').hide();
            });
        });
    </script>
@endpush
