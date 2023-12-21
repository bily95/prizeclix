@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Withdrawals history')
@section('content')
    <div class="float-end">
        <div class="mb-3 mt-0 text-end">
            <a href="{{ route('user.withdraw') }}" class="btn btn-primary">
                @lang('Cashout Now')
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel round bg-primary mb-3 py-1">
                        <div class="panel-body d-flex align-items-center justify-content-between py-1">
                            <div class="icon">
                                <i class="fas fa-chart-pie fa-2x"></i>
                            </div>
                            <div class="text-small text-center">
                                <p class="m-0 p-0">
                                    Current Balance
                                </p>
                                <p class="p-0">
                                    {{ Str::limit(showAmount(auth()->user()->balance), 15, '..') }}{{ GENERAL_SETTING['cur_sym'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel round bg-warning mb-3 py-1">
                        <div class="panel-body d-flex align-items-center justify-content-between py-1">
                            <div class="icon">
                                <i class="fas fa-cash-register fa-2x"></i>
                            </div>
                            <div class="text-small text-center">
                                <p class="m-0 p-0">
                                    Paid Balance
                                </p>
                                <p class="p-0">
                                    {{ showAmount($withdraws->where('status', 1)->sum('amount')) }}{{ GENERAL_SETTING['cur_sym'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel round bg-info mb-3 py-1">
                        <div class="panel-body d-flex align-items-center justify-content-between py-1">
                            <div class="icon">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <div class="text-small text-center">
                                <p class="m-0 p-0">
                                    Pending Balance
                                </p>
                                <p class="p-0">
                                    {{ showAmount($withdraws->where('status', 2)->sum('amount')) }}{{ GENERAL_SETTING['cur_sym'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel round bg-secondary mb-3 py-1">
                        <div class="panel-body d-flex align-items-center justify-content-between py-1">
                            <div class="icon">
                                <i class="fas fa-lock fa-2x"></i>
                            </div>
                            <div class="text-small text-center">
                                <p class="m-0 p-0">
                                    Rejected Balance
                                </p>
                                <p class="p-0">
                                    {{ showAmount($withdraws->where('status', 3)->sum('amount')) }}{{ GENERAL_SETTING['cur_sym'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Payment History</h5>

            <x-table :th="['Date', 'Amount', 'Method', 'Payment details', 'Status']">
                @forelse($withdraws->where('status', '!=', 0) as $k=>$data)
<tr>
                        <td data-label="@lang('Time')">
                            <i class="fa fa-calendar"></i> {{ showDateTime($data->created_at, 'y-m-d') }}
                            <br> {{ diffForHumans($data->created_at) }}
                        </td>
                        <td data-label="@lang('Amount')">
                            <strong>{{ showAmount($data->amount) }} </strong>
                        </td>
                        
                        <td data-label="@lang('Gateway')">{{ __($data->method->name) }}</td>

                        <td data-label="#@lang('details')">{{ $data->admin_feedback }}</td>

                        <td data-label="@lang('Status')">
                            @if ($data->status == 2)
<span class="text-small badge font-weight-normal bg-warning">@lang('Pending')</span>
@elseif($data->status == 1)
<span class="text-small badge font-weight-normal bg-success">@lang('Completed')</span>
@elseif($data->status == 3)
<span class="text-small badge font-weight-normal bg-danger">@lang('Rejected')</span>
@endif

                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __('No data found') }}</td>
                    </tr>
@endforelse
            </x-table>
            {{ $withdraws->links() }}
        </div>
    </div>

    {{-- Detail MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>

                </div>
                <div class="modal-body">

                    <div class="withdraw-detail" style="font-size: 12px;"></div>

                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-danger" data-bs-dismiss="modal"style="background: #3B4740;border-color:#3B4740;box-shadow:none;">@lang('Close')</button>-->
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush)
