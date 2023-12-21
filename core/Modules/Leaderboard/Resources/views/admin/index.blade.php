@extends('admin.layout.primary')
@section('title', __('Leaderboard '))

@section('panel')
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start" style="margin-top:5px;">@lang('LeaderBoard')</h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#storeLevel"
                    class="btn btn-sm btn-dark float-end">
                    <i class="fas fa-plus"></i> @lang('New Level')
                </button>
            </div>
            <div class="card-body">
                @isset($level)
                    @include('leaderboard::admin.edit')
                @endisset
                @isset($levels)
                    <div class="cron-link row my-3">
                        <div class="form-group col-md-6">
                            <label for="link">@lang('Cronjob daily link')</label>
                            <input type="text" class="form-control" readonly
                                value="{{ route('leaderboard.cronjob', 'daily') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link">@lang('Cronjob monthly link')</label>
                            <input type="text" class="form-control" readonly
                                value="{{ route('leaderboard.cronjob', 'monthly') }}">
                        </div>
                    </div>
                    @include('leaderboard::admin.table')
                @endisset
            </div>
        </div>
    </div>
    @include('leaderboard::admin.modal')
@endsection

@if (Request::routeIs('moder.leaderboard.edit'))
    <x-select2 />
@else
    <x-select2 modal="storeLevel" />
@endif

<x-js-notify />
