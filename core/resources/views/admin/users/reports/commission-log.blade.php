@extends('admin.layout.primary')
@section('title', $pageTitle)
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $pageTitle }}
                    </h5>
                    <form action="" method="GET" class="form-inline float-sm-right ">
                        <div class="input-group has_append">
                            <input type="text" name="search" class="form-control m-auto" placeholder="@lang('TRX')"
                                value="{{ $search ?? '' }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary m-auto" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="my-3">
                        <x-table :th="[
                            'Date',
                            'Description',
                            'Type',
                            'Transaction',
                            'Level',
                            'Percent',
                            'Amount',
                            'After balance',
                        ]">
                            @forelse($logs as $data)
                                <tr @if ($data->amount < 0) class="halka-golapi" @endif>
                                    <td data-label="@lang('Date')">{{ showDateTime($data->created_at) }}</td>
                                    <td data-label="@lang('Description')">{{ Str::limit($data->title, 5) }}</td>
                                    <td data-label="@lang('Type')">
                                        @if ($data->type == 'deposit')
                                            <span class="badge bg-success">@lang('Deposit')</span>
                                        @elseif($data->type == 'interest')
                                            <span class="badge bg-info">@lang('Interest')</span>
                                        @else
                                            <span class="badge bg-primary">@lang('WIN')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Transaction')">{{ __($data->trx) }}</td>
                                    <td data-label="@lang('Level')">{{ __(ordinal($data->level)) }}</td>
                                    <td data-label="@lang('Percent')">{{ getAmount($data->percent) }} %</td>
                                    <td data-label="@lang('Amount')"><span
                                            class="font-weight-bold">{{ __(GENERAL_SETTING['cur_sym']) }}
                                            {{ getAmount($data->commission_amount) }}</span></td>
                                    <td data-label="@lang('After balance')">{{ __(GENERAL_SETTING['cur_sym']) }}
                                        {{ getAmount($data->main_amo) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ trans($empty_message) }}
                                    </td>
                                </tr>
                            @endforelse
                        </x-table>

                        {{ $logs->links() }}
                    </div>
                </div><!-- card end -->
            </div>
        </div>
    </div>
@endsection
