@extends('admin.layout.primary')
@section('title', $pageTitle)
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ $pageTitle }}
                    </div>
                </div>
                <div class="card-body">
                    <x-table :th="['SL', 'Fullname', 'Email', 'Joined At', 'Details']">
                        @forelse($referrals as $referral)
                            <tr>
                                <td data-label="@lang('SL')">
                                    {{ $loop->iteration }}
                                </td>
                                <td data-label="@lang('Fullname')">{{ __($referral->fullname) }}
                                <td data-label="@lang('Email')">{{ __($referral->email) }}
                                </td>
                                <td data-label="@lang('Joined At')">{{ showDateTime($referral->created_at) }}</td>
                                </td>
                                <td data-label="@lang('Details')">
                                    <a href="{{ route('moder.users.detail', $referral->id) }}" class="btn btn-info btn-sm"
                                        data-toggle="tooltip" title="" data-original-title="@lang('Details')">
                                        <i class="fas fa-desktop"></i>
                                    </a>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">@lang('User Not Found')</td>
                            </tr>
                        @endforelse
                    </x-table>

                    {{ $referrals->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
