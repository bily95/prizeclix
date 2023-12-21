@extends('admin.layout.primary')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius-10 ">
                <div class="card-body">
                    <form
                        action="{{ route('moder.users.search',$scope =str_replace('admin.users.','',request()->route()->getName()) ?? 'null') }}"
                        method="GET" class="form-inline float-sm-right ">
                        <div class="input-group has_append">
                            <input type="text" name="search" class="form-control m-auto" placeholder="@lang('Username or email')"
                                value="{{ $search = '' ?? null }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary m-auto" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="btn-group-sm">
                        <a href="{{ route('moder.users.active') }}" class="btn btn-success">Active users</a>
                        <a href="{{ route('moder.users.banned') }}" class="btn btn-danger">Banned users</a>
                        <a href="{{ route('moder.users.email.unverified') }}" class="btn btn-success">Email Unverified</a>
                        <a href="{{ route('moder.users.with.balance') }}" class="btn btn-success">Have Balance</a>
                    </div>
                    <div class="my-3">
                        <x-table :th="['User', 'Country', 'Joined At', 'Balance', '']">
                            @forelse($users as $user)
                                <tr>
                                    <td data-label="@lang('User')">
                                        <span class="font-weight-bold">{{ $user->fullname }}</span>
                                        <br>
                                        <span class="small">
                                            <a
                                                href="{{ route('moder.users.detail', $user->id) }}"><span>@</span>{{ $user->username }}</a>
                                        </span>
                                    </td>
                                    <td data-label="@lang('Country')">
                                        <span class="font-weight-bold" data-toggle="tooltip"
                                            data-original-title="{{ @$user->address->country }}">{{ @$user->address->country ?? 'N/A' }}</span>
                                    </td>
                                    <td data-label="@lang('Joined At')">
                                        {{ showDateTime($user->created_at) }}
                                        <br> {{ diffForHumans($user->created_at) }}
                                    </td>
                                    <td data-label="@lang('Balance')">
                                        <span class="font-weight-bold">

                                            <i class="fas fa-coins"></i>{{ showAmount($user->balance) }}
                                        </span>
                                    </td>


                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('moder.users.detail', $user->id) }}" class="btn btn-info btn-sm"
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
                        </x-table>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
