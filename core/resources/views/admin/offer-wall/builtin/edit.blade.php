@extends('admin.layout.primary')
@section('title', __('Edit Offerwall '))
@section('panel')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @lang('Edit Offerwall')
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('moder.offer.builtin.update', $offer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ uploads('offerwalls', $offer->image) }}" height="100px" width="100px" />

                            </div>
                            <div class="col-md-6">
                                <x-bs::input type="file" name="image" accept=".png,.jpg" :label="__('Offerwall Logo')"
                                    :placeholder="__('Offerwall Logo')" />

                            </div>
                            <div class="col-md-6">
                                <x-bs::input type="text" name="name" value="{{ $offer->name }}" :label="__('Offerwall Name')"
                                    :placeholder="__('Offerwall Name')" required />
                            </div>

                            <div class="col-md-6">
                                <x-bs::input type="color" name="bgcolor" value="{{ $offer->bgcolor }}" :label="__('card background color')"
                                    :placeholder="__('card background color')" required />


                            </div>
                            <div class="col-md-12">
                                <x-bs::input type="text" name="iframe_url" value="{{ $offer->iframe_url }}"
                                    :label="__('Offerwall URL')" required
                                    placeholder="Ex:https://surveywall.wannads.com?apiKey=xxxxxxxx&userId={user_id}"
                                    :title="__('Use {user_id} as user identifier and the system will replace it.')" help="valid iframe parameters {user_id}, {secure}" />

                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($offer->offer_keys as $index => $key)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        @if ($index)
                                            <label>{{ str_replace('_', ' ', $index) }}</label>
                                        @endif
                                        <input
                                            @if ($index) type="text" 
                                    @else
                                    type="hidden" @endif
                                            name="offer_keys[{{ $index }}]" class="form-control"
                                            value="{{ $key ?? '***' }}" />
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Require User Level</label>
                                    <input type="text" name="user_level" class="form-control"
                                        value="{{ $offer->user_level }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="is_auto_pay"
                                        @if ($offer->is_auto_pay) checked="checked" @endif />
                                    <label>Is Auto Pay</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="en_api"
                                        @if ($offer->en_api) checked="checked" @endif />
                                    <label>Enable API Features</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="is_active"
                                        @if ($offer->is_active) checked="checked" @endif />
                                    <label>Is Active</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <input type="checkbox" name="is_available"
                                        @if ($offer->is_available) checked="checked" @endif />
                                    <label>Is Available</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $offer->id }}" />
                <input type="hidden" name="is_builtin" value="{{ $offer->id }}" />
                <input type="submit" value="Save" class="btn btn-primary mt-3" />
            </form>
        </div>
    </div>
@endsection
<x-js-notify />
<x-bootstrap-toggle />
