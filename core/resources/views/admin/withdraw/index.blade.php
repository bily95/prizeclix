@extends('admin.layout.primary')
@section('title', __('Cashout Methods '))
@section('page-title', __('Cashout Methods '))
@section('panel')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title float-start">@lang('Manage Cashouts Methods')</h4>
            <a class="btn btn-sm btn-primary float-end" href="{{ route('moder.withdraw.method.create') }}"><i
                    class="fa fa-fw fa-plus">
                </i>@lang('Add New')</a>
        </div>
        <div class="card-body">
            <x-table :th="['Method', 'Currency', 'Charge', 'Withdraw Limit', 'Processing Time', 'Status', 'Action']">
                @forelse($methods as $method)
                    <tr>
                        <td data-label="@lang('Method')">
                            <div class="user">
                                <div class="thumb">
                                    <x-bs::image
                                        src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $method->image, imagePath()['withdraw']['method']['size']) }}"
                                        height="25" />
                                </div>

                                <span class="name">{{ __($method->name) }}</span>
                            </div>
                        </td>

                        <td data-label="@lang('Currency')" class="font-weight-bold">
                            {{ __($method->currency) }}</td>
                        <td data-label="@lang('Charge')" class="font-weight-bold">
                            {{ showAmount($method->fixed_charge) }} {{ __(GENERAL_SETTING['cur_text']) }}
                            {{ 0 < $method->percent_charge ? ' + ' . showAmount($method->percent_charge) . ' %' : '' }}
                        </td>
                        <td data-label="@lang('Withdraw Limit')" class="font-weight-bold">
                            {{ $method->min_limit + 0 }}
                            - {{ $method->max_limit + 0 }} {{ __(GENERAL_SETTING['cur_text']) }}</td>
                        <td data-label="@lang('Processing Time')">{{ $method->delay }}</td>
                        <td data-label="@lang('Status')">
                            @if ($method->status == 1)
                                <span class="text-small badge font-weight-normal bg-success">@lang('Active')</span>
                            @else
                                <span class="text-small badge font-weight-normal bg-warning">@lang('Disabled')</span>
                            @endif
                        </td>
                        <td data-label="@lang('Action')">
                            <a href="{{ route('moder.withdraw.method.edit', $method->id) }}" class="btn btn-info btn-sm ml-1"
                                data-toggle="tooltip" data-original-title="@lang('Edit')"><i
                                    class="fas fa-pen"></i></a>
                            @if ($method->status == 1)
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger deactivateBtn  ml-1"
                                    data-toggle="tooltip" data-original-title="@lang('Disable')"
                                    data-id="{{ $method->id }}" data-name="{{ __($method->name) }}"
                                   >
                                    <i class="fa fa-eye-slash"></i>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="btn btn-sm btn-success activateBtn  ml-1"
                                    data-toggle="tooltip" data-original-title="@lang('Enable')"
                                    data-id="{{ $method->id }}" data-name="{{ __($method->name) }}"
                                   >
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                    </tr>
                @endforelse
            </x-table>

        </div>
    </div>


    {{-- ACTIVATEMETHODMODAL- --}}
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Withdrawal Method Activation Confirmation')</h5>

                </div>
                <form action="{{ route('moder.withdraw.method.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to activate') <span class="font-weight-bold method-name"></span>
                            @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Activate')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DEACTIVATEMETHODMODAL- --}}
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:20px;">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Want to disable this method?')</h5>

                </div>
                <form action="{{ route('moder.withdraw.method.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to disable') <span class="font-weight-bold method-name"></span>
                            @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger">@lang('Disable')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
<x-js-notify />
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.activateBtn').on('click', function() {
                var modal = $('#activateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.deactivateBtn').on('click', function() {
                var modal = $('#deactivateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
