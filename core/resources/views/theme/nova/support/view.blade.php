@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Tickets Viewer')
@section('content')
  <div class="card">
    <div class="card-body">
      <h5 class="card-title float-start">
        @if ($my_ticket->status == 0)
          <span class="badge badge--success px-3 py-2">@lang('Open')</span>
        @elseif($my_ticket->status == 1)
          <span class="badge badge--primary px-3 py-2">@lang('Answered')</span>
        @elseif($my_ticket->status == 2)
          <span class="badge badge--warning px-3 py-2">@lang('Replied')</span>
        @elseif($my_ticket->status == 3)
          <span class="badge badge--dark px-3 py-2">@lang('Closed')</span>
        @endif
        [@lang('Ticket')#{{ $my_ticket->ticket }}] {{ $my_ticket->subject }}
      </h5>
      @if ($my_ticket->status != 3)
        <button class="btn btn-danger btn-sm close-button float-end" type="button" title="@lang('Close Ticket')" data-bs-toggle="modal" data-bs-target="#DelModal"><i class="fa fa-lg fa-times-circle"></i>
        </button>
      @endif
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-body">
        @if ($my_ticket->status != 3)
          <form method="post" action="{{ route('user.ticket.reply', $my_ticket->id) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="replayTicket" value="1">
            <div class="row justify-content-between">
              <div class="col-md-12">
                <div class="form-group">
                  <textarea name="message" class="form-control form-control-lg" id="inputMessage" placeholder="@lang('Your Reply')" rows="4" cols="10" required></textarea>
                </div>
              </div>
            </div>
            <div class="row justify-content-between">
              <div class="col-md-8">
                <div class="row justify-content-between">
                  <div class="col-md-11">
                    <div class="position-relative">
                      <input type="file" name="attachments[]" id="inputAttachments" class="form-control custom--file-upload my-1" />
                    </div>
                    <div id="fileUploadsContainer"></div>
                    <p class="ticket-attachments-message text-muted my-2">
                      @lang('Allowed File Extensions'): .@lang('jpg'),
                      .@lang('jpeg'), .@lang('png'),
                      .@lang('pdf'),
                      .@lang('doc'), .@lang('docx')
                    </p>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <a href="javascript:void(0)" class="btn btn-primary btn-sm addFile mt-1">
                        <i class="fa fa-plus"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <button type="submit" class="btn btn-primary custom-success mt-1">
                  <i class="fa fa-reply"></i> @lang('Reply')
                </button>
              </div>
            </div>
          </form>
        @else
          <h3>@lang('Your Ticket closed,')
            <br />
            @lang('You Can') <a href="{{ route('user.ticket.open') }}">@lang('Open new')</a>
          </h3>
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          @foreach ($messages as $message)
            @if ($message->admin_id == 0)
              <div class="row border-primary border-radius-3 mx-2 my-3 border py-3">
                <div class="col-md-3 border-right text-right">
                  <h5 class="my-3">{{ $message->ticket->name }}</h5>
                </div>
                <div class="col-md-9">
                  <p class="text-muted font-weight-bold my-3">
                    @lang('Posted on')
                    {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                  <p>{{ $message->message }}</p>
                  @if ($message->attachments()->count() > 0)
                    <div class="mt-2">
                      @foreach ($message->attachments as $k => $image)
                        <a href="{{ route('user.ticket.download', encrypt($image->id)) }}" class="mr-3"><i class="fa fa-file"></i> @lang('Attachment')
                          {{ ++$k }}
                        </a>
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
            @else
              <div class="row border-warning border-radius-3 mx-2 my-3 border py-3" style="background-color: #ffd96729">
                <div class="col-md-3 border-right text-right">
                  <h5 class="my-3">{{ $message->admin->name }}</h5>
                  <p class="lead text-muted">@lang('Staff')</p>
                </div>
                <div class="col-md-9">
                  <p class="text-muted font-weight-bold my-3">
                    @lang('Posted on')
                    {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                  <p>{{ $message->message }}</p>
                  @if ($message->attachments()->count() > 0)
                    <div class="mt-2">
                      @foreach ($message->attachments as $k => $image)
                        <a href="{{ route('user.ticket.download', encrypt($image->id)) }}" class="mr-3"><i class="fa fa-file"></i> @lang('Attachment')
                          {{ ++$k }}
                        </a>
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="{{ route('user.ticket.reply', $my_ticket->id) }}">
          @csrf

          <input type="hidden" name="replayTicket" value="2">
          <div class="modal-header">
            <h5 class="modal-title"> @lang('Confirmation')!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <strong>@lang('Are you sure you want to close this support ticket')?</strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal"><i class="fa fa-times"></i>
              @lang('Close')
            </button>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i>
              @lang('Confirm')
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    (function($) {
      "use strict";
      $('.delete-message').on('click', function(e) {
        $('.message_id').val($(this).data('id'));

      });
      $('.addFile').on('click', function() {
        $("#fileUploadsContainer").append(
          `<div class="position-relative">
                <input type="file" name="attachments[]" id="inputAttachments" class="form-control custom-file-upload my-1"/>
            </div>`
        )
      });
    })(jQuery);
  </script>
@endpush
