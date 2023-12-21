@extends('admin.layout.primary')
@section('title', __('Leaderboard History '))
@section('panel')
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start" style="margin-top:5px;">@lang('Leaderboard History')</h4>
            </div>
            <div class="table-header">
                <form action="{{ route('moder.leaderboard.history') }}" method="get" class="history-search">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-flex align-items-center justify-content-center">
                                <input type="search" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Search for user by: username, firstname, lastname, email, as well task title" />
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="for-group" onchange="$('.history-search').submit()">
                                <select class="form-control" name="type">
                                    <option value="all" @if(request('type', 'all') === 'all') selected @endif>Show All</option>
                                    <option value="daily" @if(request('type') === 'daily') selected @endif>Daily Only</option>
                                    <option value="monthly" @if(request('type') === 'monthly') selected @endif>Monthly Only</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="overflow-auto">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>@lang('#')</th>
                            <th>@lang('Username')</th>
                            <th>@lang('Type')</th>
                            <th>@lang('Rewards')</th>
                            <th>@lang('Date')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $currentPage = $history->currentPage(); @endphp
                        @forelse($history as $index => $log)
                            <tr>
                                <td>
                                    {{ $currentPage + $index++ }}
                                </td>
                                <td>
                                    {{ @$log->user->username }}
                                </td>
                                <td>
                                    {{ $log->type }}
                                </td>
                                <td>
                                    {{ $log->reward }}
                                </td>

                                <td data-label="@lang('Date')">
                                    {{ showDateTime($log->created_at) }}
                                    <br>
                                    {{ diffForHumans($log->created_at) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{ $history->links() }}
            </div>
        </div>
    </div>
@endsection
