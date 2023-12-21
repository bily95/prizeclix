@extends('admin.layout.primary')

@section('panel')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body ">
                    <a href="{{ route('moder.ticket.index') }}" class="btn btn-sm btn-primary my-1 text-small"><i
                            class="fa fa-fw fa-backward"></i> @lang('Go Back') </a>
                    <h6 class="card-header  my-2">
                        <div class="row">
                            <div class="col-sm-8 col-md-6">
                                @if ($ticket->status == 0)
                                    <span class="badge bg-success py-1 px-2">@lang('Open')</span>
                                @elseif($ticket->status == 1)
                                    <span class="badge bg-primary py-1 px-2">@lang('Answered')</span>
                                @elseif($ticket->status == 2)
                                    <span class="badge bg-warning py-1 px-2">@lang('Customer Reply')</span>
                                @elseif($ticket->status == 3)
                                    <span class="badge bg-dark py-1 px-2">@lang('Closed')</span>
                                @endif
                                [@lang('Ticket#'){{ $ticket->ticket }}] {{ $ticket->subject }}
                            </div>
                            <div class="col-sm-4  col-md-6 text-sm-right mt-sm-0 mt-3">
                                @if ($ticket->status != 3)
                                    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal"
                                        data-bs-target="#DelModal">
                                        <i class="fa fa-lg fa-times-circle"></i> @lang('Close Ticket')
                                    </button>
                                @endif
                            </div>
                        </div>
                    </h6>

                    @if ($ticket->status != 3)
                    <form action="{{ route('moder.ticket.reply', $ticket->id) }}" enctype="multipart/form-data"
                        method="post" class="form-horizontal">
                        @csrf


                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control my-1" name="message" rows="3" id="inputMessage"
                                        placeholder="@lang('Your Message')" style="height: 100px"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col-9 ">
                                        <div class="custom-file" data-text="@lang('Select your file!')">
                                            <input type="file" name="attachments[]" id="inputAttachments"
                                                class="form-control" />
                                            <label for="inputAttachments"
                                                class="custom-file-label">@lang('Attachments')</label>
                                        </div>
                                        <div id="fileUploadsContainer"></div>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-dark extraTicketAttachment"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-12 ticket-attachments-message text-muted mt-3">
                                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'),
                                        .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 offset-md-3">
                                <button class="btn btn-primary btn-block mt-4" type="submit" name="replayTicket"
                                    value="1"><i class="fas fa-fw la-lg fa-reply"></i> @lang('Reply')
                                </button>
                            </div>
                        </div>
                    </form>
                    @else
                    <h3>@lang('This is closed ticket') 
                         </h3>
                    @endif

                    @foreach ($messages as $message)
                        @if ($message->admin_id == 0)
                            <div class="row border border-primary border-radius-3 my-3 mx-2">

                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3">{{ $ticket->name }}</h5>
                                    <button data-id="{{ $message->id }}" type="button" data-bs-toggle="modal"
                                        data-bs-target="#DelMessage" class="btn btn-danger btn-sm my-3 delete-message">
                                        <i class="fa fa-trash"></i> @lang('Delete')</button>
                                </div>

                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        @lang('Posted on') {{ showDateTime($message->created_at, 'l, dS F Y @ H:i') }}</p>
                                    <p>{{ $message->message }}</p>
                                    @if ($message->attachments()->count() > 0)
                                        <div class="my-3">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('moder.ticket.download', encrypt($image->id)) }}"
                                                    class="mr-3"><i class="fa fa-file"></i>@lang('Attachment')
                                                    {{ ++$k }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row border border-warning border-radius-3 my-3 mx-2 admin-bg-reply">

                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3">{{ @$message->admin->name }}</h5>
                                    <p class="lead text-muted">@lang('Staff')</p>
                                    <button data-id="{{ $message->id }}" type="button" data-bs-toggle="modal"
                                        data-bs-target="#DelMessage" class="btn btn-danger btn-sm my-3 delete-message">
                                        <i class="fa fa-trash"></i> @lang('Delete')</button>
                                </div>

                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        @lang('Posted on') {{ showDateTime($message->created_at, 'l, dS F Y @ H:i') }}
                                    </p>
                                    <p>{{ $message->message }}</p>
                                    @if ($message->attachments()->count() > 0)
                                        <div class="my-3">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('moder.ticket.download', encrypt($image->id)) }}"
                                                    class="mr-3"><i class="fa fa-file"></i>
                                                    @lang('Attachment') {{ ++$k }} </a>
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




    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Close Support Ticket!')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>@lang('Are you want to close this support ticket?')</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('moder.ticket.reply', $ticket->id) }}">
                        @csrf

                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close') </button>
                        <button type="submit" class="btn btn-success" name="replayTicket" value="2"> @lang('Close Ticket')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="DelMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Delete Reply!')</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>@lang('Are you sure to delete this?')</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('moder.ticket.delete') }}">
                        @csrf
                        <input type="hidden" name="message_id" class="message_id">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('No') </button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> @lang('Delete')
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        "use strict";
        (function($) {
            $('.delete-message').on('click', function(e) {
                $('.message_id').val($(this).data('id'));
            })
            $('.extraTicketAttachment').on('click', function() {
                $("#fileUploadsContainer").append(
                    `
                <div class="file-upload-wrapper" data-text="@lang('Select your file!')"><input type="file" name="attachments[]" id="inputAttachments" class="form-control"/></div>`
                )
            });
        })(jQuery);
    </script>
    @section('editor', true)
@endpush
