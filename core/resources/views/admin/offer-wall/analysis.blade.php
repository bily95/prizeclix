@extends('admin.layout.primary')
@section('title', __('Offers Stats '))   
@section('panel')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @lang('Offers Stats')
            </h3>
        </div>
        <div class="card-body">
            @livewire('admin.offerwall.admin-offer-analysis')
        </div>
    </div>
@endsection