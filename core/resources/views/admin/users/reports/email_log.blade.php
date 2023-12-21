@extends('admin.layout.primary')
@section('title', $pageTitle)
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <h5 class="card-title float-start">
                        {{ $pageTitle }}
                    </h5>
                    <a href="{{ route('moder.users.detail', $user->id) }}" class="btn btn-info float-end"
                        style="box-shadow:none;background:#067fda;border-color:#067fda;border-top-right-radius:0px;border-top-left-radius:10px;border-bottom-left-radius:0px"><i
                            class="fas fa-user"></i> {{ $user->fullname }}</a>
                    <div class="clearfix"></div>
                    <div class="my-3">
                        <x-table :th="['User', 'Sent', 'Mail Sender', 'Subject', 'Action']">
                            @forelse($logs as $log)
                                <tr>
                                    <td data-label="@lang('User')">
                                        <span class="font-weight-bold">{{ $log->user->fullname }}</span>
                                        <br>
                                        <span class="small">
                                            <a
                                                href="{{ route('moder.users.detail', $log->user_id) }}"><span>@</span>{{ $log->user->username }}</a>
                                        </span>
                                    </td>
                                    <td data-label="@lang('Sent')">
                                        {{ showDateTime($log->created_at) }}
                                        <br>
                                        {{ $log->created_at->diffForHumans() }}
                                    </td>
                                    <td data-label="@lang('Mail Sender')">
                                        <span class="font-weight-bold">{{ __($log->mail_sender) }}</span>
                                    </td>
                                    <td data-label="@lang('Subject')">{{ __($log->subject) }}</td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('moder.users.email.details', $log->id) }}"> <i class="fas fa-desktop"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </x-table>
                        {{ $logs->links() }}
                    </div>
                </div><!-- card end -->
            </div>
        </div>
    @endsection
