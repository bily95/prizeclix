@section('title', __('Manage Support Tickets'))
@section('page-title', __('Manage Support Tickets'))
<div>
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">@lang('Manage Support Tickets')</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <input type="search" class="form-control" wire:model="search" :placeholder="__('Search By Sender')" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <select wire:model="status" class="form-control">
              <option value="">@lang('Filter By Status')</option>
              <option value="0">@lang('Open')</option>
              <option value="1">@lang('Answered')</option>
              <option value="2">@lang('Customer Reply')</option>
              <option value="3">@lang('Closed')</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <select wire:model="priority" class="form-control">
              <option>@lang('Filter By Priority')</option>
              <option value="1">@lang('Low')</option>
              <option value="2">@lang('Medium')</option>
              <option value="3">@lang('High')</option>
            </select>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="my-3">
            <x-table :th="['Subject', 'Submitted By', 'Status', 'Priority', 'Last Reply', 'Action']">
              @if (!empty($status) || $status == '0')
                @php  $items = $items->where('status', $status) @endphp
              @elseif (!empty($priority))
                @php  $items = $items->where('priority', $priority) @endphp
              @endif

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
                      <span class="badge bg-primary">@lang('Answered')</span>
                    @elseif($item->status == 2)
                      <span class="badge bg-warning">@lang('Customer Reply')</span>
                    @elseif($item->status == 3)
                      <span class="badge bg-info">@lang('Closed')</span>
                    @endif
                  </td>
                  <td data-label="@lang('Priority')">
                    @if ($item->priority == 1)
                      <span class="badge bg-info">@lang('Low')</span>
                    @elseif($item->priority == 2)
                      <span class="badge bg-warning">@lang('Medium')</span>
                    @elseif($item->priority == 3)
                      <span class="badge bg-danger">@lang('High')</span>
                    @endif
                  </td>

                  <td data-label="@lang('Last Reply')">
                    {{ diffForHumans($item->last_reply) }}
                  </td>

                  <td data-label="@lang('Action')">
                    <a href="{{ route('moder.ticket.view', $item->id) }}" class="icon-btn ml-1" data-toggle="tooltip" title="" data-original-title="@lang('Details')">
                      <i class="fas fa-desktop"></i>
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}
                  </td>
                </tr>
              @endforelse
            </x-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
