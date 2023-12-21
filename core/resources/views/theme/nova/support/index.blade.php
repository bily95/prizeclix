@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Contact Us')
@section('content')
  <div class="card pt-100 pb-100">

    <div class="card-body">
      <h4 class="card-title float-start">@lang('Contact US')</h4>
      <div class="mb-3 float-end">
        <a href="{{ route('user.ticket.open') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-plus"></i> @lang('New Ticket')
        </a>
      </div>
      <div class="clearfix"></div>
      <div class="row justify-content-center">
        <x-table :th="['Subject', 'Status', 'Priority', 'Last Reply', 'Action']">
          @forelse($supports as $key => $support)
            <tr>
              <td data-label="@lang('Subject')"><a href="{{ route('user.ticket.view', $support->ticket) }}" class="font-weight-bold">
                  @lang('Ticket')
                  {{ __($support->subject) }} </a></td>
              <td data-label="@lang('Status')">
                @if ($support->status == 0)
                  <span class="badge badge-success px-3 py-2">@lang('Open')</span>
                @elseif($support->status == 1)
                  <span class="badge badge-primary px-3 py-2">@lang('Answered')</span>
                @elseif($support->status == 2)
                  <span class="badge badge-warning px-3 py-2">@lang('Customer Reply')</span>
                @elseif($support->status == 3)
                  <span class="badge badge-dark px-3 py-2">@lang('Closed')</span>
                @endif
              </td>
              <td data-label="@lang('Priority')">
                @if ($support->priority == 1)
                  <span class="badge badge-dark px-3 py-2">@lang('Low')</span>
                @elseif($support->priority == 2)
                  <span class="badge badge-success px-3 py-2">@lang('Medium')</span>
                @elseif($support->priority == 3)
                  <span class="badge badge-primary px-3 py-2">@lang('High')</span>
                @endif
              </td>
              <td data-label="@lang('Last Reply')">
                {{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

              <td data-label="@lang('Action')">
                <a href="{{ route('user.ticket.view', $support->ticket) }}" class="btn btn-primary btn-sm">
                  <i class="fa fa-file" title="{{ __('Read') }}"></i>
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="100%" class="text-center"> @lang('No results found')!</td>
            </tr>
          @endforelse
        </x-table>
        {{ $supports->links() }}
      </div>
    </div>
  </div>
@endsection
