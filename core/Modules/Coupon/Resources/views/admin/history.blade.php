@extends('admin.layout.primary')
@section('title', __('Coupon System History'))
@section('panel')
    <form action="">
        <div class="form-group d-flex justify-content-center align-items-center">
            <input type="search" name="s" class="form-control"
                placeholder="Coupon Code, Username, Firstname, Lastname, Email" value="{{ request('s') }}" />
            <button type="submit" class="btn btn-info">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <div class="clearfix"></div>
    <div class="table-responsive-sm">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Coupon</th>
                    <th>User</th>
                    <th>Rewards</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $index => $item)
                    @if ($item->coupon)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->coupon->token }}</td>
                            <td>
                                <a href="{{ route('moder.users.detail', $item->user->id) }}">
                                    {{ $item->user->username }}
                                </a>
                            </td>
                            <td>{{ $item->coupon->rewards }}{{ GENERAL_SETTING['cur_sym'] }}</td>
                            <td>{{ showDateTime($item->created_at) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{ $logs->links() }}
    </div>

@endsection
<x-js-notify />
