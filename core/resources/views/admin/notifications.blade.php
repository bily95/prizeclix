@extends('admin.layout.primary')
@section('title', __('Notifications '))
@section('panel')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@lang('Manage Notifications') </h3>
        </div>
        <div class="card-body">
            <a href="{{ route('moder.notifications.readAll') }}" class="btn btn-primary float-end" style="background:#067fda;border-color:#067fda;box-shadow:none">@lang('Mark all as
                read')</a>
            @foreach ($notifications as $notification)
                <div class="panel">
                    <div class="panel-body">
                        <a class="nav-link" href="{{ route('moder.notification.read', $notification->id) }}">
                            <h6>{{ $notification->title }}</h6>
                            <span class="date"><i class="fas fa-clock"></i>
                                {{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                    </div>
                    <div class="panel-footer d-flex">
                        @if ($notification->read_status == 0)
                            <x-bs::button color="light" href="{{ route('moder.notification.read', $notification->id) }}"
                                icon="envelope" title="Read" size="sm" class="mx-1" style="background:#067fda;border-color:#067fda;box-shadow:none" />
                        @else
                            <x-bs::button color="light" href="#" icon="envelope-open" title="Readed" size="sm"
                                class="mx-1"  style="box-shadow:none" />
                        @endif
                        <x-bs::button href="{{ route('moder.notification.delete', $notification->id) }}" icon="trash"
                            title="delete" size="sm" class="mx-1" confirmed  style="background:#e84b3c;border-color:#e84b3c;box-shadow:none"/>
                    </div>
                </div>
            @endforeach
            {{ paginateLinks($notifications) }}
        </div>
    </div>
@endsection
