@extends('admin.layout.primary')
@section('title')
    {{ $pageTitle }}
@endsection
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <x-table :th="['User', 'Trx', 'Transacted', 'Amount', 'Post Balance', 'Detail']">
                        @forelse($transactions as $trx)
                            <tr>
                                <td data-label="@lang('User')">
                                    <span class="font-weight-bold">{{ @$trx->user->fullname }}</span>
                                    <br>
                                    <span class="small"> <a
                                            href="{{ route('moder.users.detail', $trx->user_id) }}"><span>@</span>{{ @$trx->user->username }}</a>
                                    </span>
                                </td>

                                <td data-label="@lang('Trx')">
                                    <strong>{{ $trx->trx }}</strong>
                                </td>

                                <td data-label="@lang('Transacted')">
                                    {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                </td>

                                <td data-label="@lang('Amount')" class="budget">
                                    <span
                                        class="font-weight-bold @if ($trx->trx_type == '+') text-success @else text-danger @endif">
                                        {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                        {{ GENERAL_SETTING['cur_text'] }}
                                    </span>
                                </td>

                                <td data-label="@lang('Post Balance')" class="budget">
                                    {{ showAmount($trx->post_balance) }} {{ __(GENERAL_SETTING['cur_text']) }}
                                </td>


                                <td data-label="@lang('Detail')">{{ __($trx->details) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </x-table>

                    {{ $transactions->links() }}
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
