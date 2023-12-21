@extends('admin.layout.primary')
@section('title', __('Daily tasks '))
@section('panel')
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start" style="margin-top:5px;">@lang('Daily Tasks')</h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#storeLevel"
                    class="btn btn-sm btn-dark float-end">
                    <i class="fas fa-plus"></i> @lang('New task')
                </button>
            </div>
            @isset($task)
            @include('dailytasks::admin.edit')
            @endisset
            @isset($tasks)
                @include('dailytasks::admin.table')
            @endisset
        </div>
    </div>
    </div>
    @include('dailytasks::admin.modal')
@endsection
<x-js-notify />
