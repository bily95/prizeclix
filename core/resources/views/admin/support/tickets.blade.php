@extends('admin.layout.primary')

@section('panel')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('Manage Pending Tickets')</h4>
        </div>
        <div class="card-body">
            <div class="overflow-auto">
                <table class="table table-bordered table-striped table-hover table-responsive-sm">
                    <thead>
                    <tr>
                        <th>@lang('Subject')</th>
                        <th>@lang('Submitted By')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Priority')</th>
                        <th>@lang('Last Reply')</th>
                        <th>@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td data-label="@lang('Subject')">
                                <a href="{{ route('moder.ticket.view', $item->id) }}" class="font-weight-bold">
                                    [@lang('Ticket')#{{ $item->ticket }}] {{ $item->subject }} </a>
                            </td>

                            <td data-label="@lang('Submitted By')">

                                <p class="font-weight-bold"> {{ $item->name }}</p>

                            </td>
                            <td data-label="@lang('Status')">
                                @if ($item->status == 0)
                                    <span class="badge bg-success">@lang('Open')</span>
                                @elseif($item->status == 1)
                                    <span class="badge  bg-primary">@lang('Answered')</span>
                                @elseif($item->status == 2)
                                    <span class="badge bg-warning">@lang('Customer Reply')</span>
                                @elseif($item->status == 3)
                                    <span class="badge bg-danger" >@lang('Closed')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Priority')">
                                @if ($item->priority == 1)
                                    <span class="badg bg-info">@lang('Low')</span>
                                @elseif($item->priority == 2)
                                    <span class="badge  bg-warning">@lang('Medium')</span>
                                @elseif($item->priority == 3)
                                    <span class="badge bg-danger">@lang('High')</span>
                                @endif
                            </td>

                            <td data-label="@lang('Last Reply')">
                                {{ diffForHumans($item->last_reply) }}
                            </td>

                            <td data-label="@lang('Action')">
                                <a href="{{ route('moder.ticket.view', $item->id) }}" class="icon-btn  ml-1"
                                   data-toggle="tooltip" title="" data-original-title="@lang('Details')">
                                    <i class="fas fa-desktop"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
              
            </div>
        </div>
        <div class="card-footer py-4">
            {{ paginateLinks($items) }}
        </div>
    </div>
@endsection

