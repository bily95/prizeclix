@extends( SETTING['site_theme'] . 'layouts.app')

@section('title', __('Leaderboard'))

@section('content')
    <section class="pt-100 pb-100">
        <div class="container card">
            <div class="row justify-content-center mt-2">
                <div class="col-md-12">
                    <div class="levels-rewards my-3">
                        @include('leaderboard::user.links')
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="levels-rewards my-3">
                        <div class="button-group float-start">
                            <a href="{{ route('user.leaderboard.history', 'daily') }}" class="btn btn-dark text-right">
                                @lang('Daily')
                            </a>

                            <a href="{{ route('user.leaderboard.history', 'monthly') }}" class="btn btn-dark text-right">
                                @lang('Monthly')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-responsive-md custom-table">
                        <thead>
                            <tr>
                                <th>@lang('ID')</th>
                                <th>@lang('User Name')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $pageNumber = $logs->currentPage();
                            @endphp
                            @forelse($logs as $index => $log)
                                <tr>
                                    <td data-label="@lang('Id')">#{{ $pageNumber + $index++ }}</td>
                                    <td data-label="@lang('User Name')">{{ $log->user->username }}</td>
                                    <td data-label="@lang('User Name')">{{ $log->reward }}{{ GENERAL_SETTING['cur_sym'] }}</td>
                                    <td data-label="@lang('Date')">
                                        {{ $log->created_at }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">@lang('Data not found')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
