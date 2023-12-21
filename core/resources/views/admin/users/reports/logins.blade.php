@extends('admin.layout.primary')
@section('title', $pageTitle)
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $pageTitle }}
                    </h5>
                    <div class="my-3">
                        <x-table :th="['User', 'Login at', 'IP', 'Location', 'Browser | OS']">
                            @forelse($login_logs as $log)
                                <tr>

                                    <td data-label="@lang('User')">
                                        <span class="font-weight-bold">{{ @$log->user->fullname }}</span>
                                        <br>
                                        <span class="small"> <a
                                                href="{{ route('moder.users.detail', $log->user_id) }}"><span>@</span>{{ @$log->user->username }}</a>
                                        </span>
                                    </td>

                                    <td data-label="@lang('Login at')">
                                        {{ showDateTime($log->created_at) }} <br>
                                        {{ diffForHumans($log->created_at) }}
                                    </td>

                                    <td data-label="@lang('IP')">
                                        <span class="font-weight-bold">
                                            {{ $log->user_ip }}
                                        </span>
                                    </td>

                                    <td data-label="@lang('Location')">{{ __($log->city) }} <br>
                                        {{ __($log->country) }}</td>
                                    <td data-label="@lang('Browser | OS')">
                                        {{ __($log->browser) }} <br> {{ __($log->os) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </x-table>

                        {{ $login_logs->links() }}
                    </div>
                </div><!-- card end -->
            </div>
        </div>
    </div>
@endsection
