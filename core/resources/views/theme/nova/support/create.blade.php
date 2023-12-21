@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Open support ticket')
@section('content')
  <div class="card">
    <div class="card-body">
      <h5 class="card-title float-start">New ticket</h5>
      <a href="{{ route('user.ticket') }}" class="btn btn-primary float-end">
        @lang('My Support Ticket')
      </a>
      <div class="clearfix"></div>
      <form action="{{ route('user.ticket.store') }}" method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
        @csrf
        <div class="row">
          <div class="form-group col-md-6">
            <label for="name">@lang('Name')</label>
            <input type="text" name="name" value="{{ @$user->username }}" class="form-control form-control-lg" placeholder="@lang('Enter your name')" readonly>
          </div>
          <div class="form-group col-md-6">
            <label for="email">@lang('Email address')</label>
            <input type="email" name="email" value="{{ @$user->email }}" class="form-control form-control-lg" placeholder="@lang('Enter your email')" readonly>
          </div>

          <div class="form-group col-md-6">
            <label for="website">@lang('Subject')</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control form-control-lg" placeholder="@lang('Subject')">
          </div>
          <div class="form-group col-md-6">
            <label for="priority">@lang('Priority')</label>
            <select name="priority" class="form-control form-control-lg">
              <option value="3">@lang('High')</option>
              <option value="2">@lang('Medium')</option>
              <option value="1">@lang('Low')</option>
            </select>
          </div>
          <div class="col-12 form-group">
            <label for="inputMessage">@lang('Message')</label>
            <textarea name="message" id="inputMessage" rows="6" class="form-control form-control-lg">{{ old('message') }}</textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-8 file-upload">
            <div class="position-relative">
              <input type="file" name="attachments[]" id="inputAttachments" class="form-control custom-file-upload my-1" />
            </div>

            <div id="fileUploadsContainer"></div>
            <p class="ticket-attachments-message text-muted">
              @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'),
              .@lang('pdf'), .@lang('doc'), .@lang('docx')
            </p>
          </div>

          <div class="col-1 mt-1">
            <button type="button" class="btn btn-primary btn-sm addFile">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>

        <div class="row form-group justify-content-center">
          <div class="col-md-12">
            <button class="btn btn-primary mt-2" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('script')
  <script>
    (function($) {
      "use strict";
      $('.addFile').on('click', function() {
        $("#fileUploadsContainer").append(`
                    <div class="position-relative">
                        <input type="file" name="attachments[]" id="inputAttachments" class="form-control custom--file-upload my-1"/>
                    </div>
                `)
      });
    })(jQuery);
  </script>
@endpush
