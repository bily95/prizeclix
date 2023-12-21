@extends('admin.layout.primary')

@section('panel')
    <a href="{{ route('moder.users.all') }}" class="btn btn-sm btn-primary box-shadow1 text-small">
        <i class="fa fa-fw fa-backward"></i> @lang('Go Back') </a>
    <div class="row mb-none-30">
        <div class="col-12">
            <div class="card card-frame mb-2">
                <div class="card-body">
                    <h5 class="p-0 mb-0">
                        @lang('Manage User: ') {{ $user->username }}
                    </h5>
                    <p>{{ $user->fullname }} <br />
                    Joined At: {{ showDateTime($user->created_at, 'd M, Y h:i A') }} <br />
                    Referred By: @if ($reff != null)
                            <a href="{{ route('moder.users.detail', $reff->id) }}"> {{ $reff->username }} </a>
                        @else
                            @lang('none')
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">
            <div class="card b-radius-10 overflow-hidden mt-30 shadow">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Actions')</h5>
                    <a data-bs-toggle="modal" href="#addSubModal" class="btn btn-success  btn-block my-1 w-100">
                        @lang('Add/Subtract Balance')
                    </a>
                    <a href="{{ route('moder.users.login.history.single', $user->id) }}"
                        class="btn btn-primary  btn-block my-1 w-100">
                        @lang('Login Logs')
                    </a>
                    <a href="{{ route('moder.users.email.single', $user->id) }}" class="btn btn-info btn-block my-1 w-100">
                        @lang('Send Email')
                    </a>
                    <a href="{{ route('moder.users.login', $user->id) }}" target="_blank"
                        class="btn btn-dark  btn-block my-1 w-100">
                        @lang('Login as User')
                    </a>
                    <a href="{{ route('moder.users.email.log', $user->id) }}"
                        class="btn btn-warning  btn-block my-1 w-100">
                        @lang('Email Log')
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="row mb-none-30">
                @include('admin.users.partials.user-statist')
            </div>


            <div class="card mt-50">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">@lang('User Information')</h5>
                    @include('admin.users.partials.user-info')
                </div>
            </div>
        </div>
    </div>



    {{-- Add Sub Balance MODAL --}}
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add / Subtract Balance')</h5>

                </div>
                <form action="{{ route('moder.users.add.sub.balance', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-6oup col-md-12">
                                <input type="checkbox" data-on="@lang('Add Balance')" data-off="@lang('Subtract Balance')"
                                    name="act" checked>
                            </div>


                            <div class="form-group col-md-12">
                                <label>@lang('Amount')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="amount" class="form-control"
                                        placeholder="@lang('Please provide positive amount')">
                                    <div class="input-group-append">
                                        <div class="input-group-text btn-primary"><i class="fas fa-coins"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<x-js-notify />
<x-bootstrap-toggle />
<x-select2 search="true" />
