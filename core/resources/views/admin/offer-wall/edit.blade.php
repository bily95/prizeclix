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
            <form action="{{ route('moder.offer.update', $offer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ uploads('offerwalls', $offer->image) }}" height="100px" width="100px"/>

                            </div>
                            <div class="col-md-6">
                                <x-bs::input type="file" name="image" accept=".png,.jpg" :label="__('Offerwall Logo')" :placeholder="__('Offerwall Logo')" />
                               
                            </div>
                            <div class="col-md-6">
                                <x-bs::input type="text" name="name" value="{{ $offer->name }}" :label="__('Offerwall Name')"
                                    :placeholder="__('Offerwall Name')"   required />
                               

                            </div>
                            <div class="col-md-6">
                                <x-bs::input type="color" name="bgcolor" value="{{ $offer->bgcolor }}" :label="__('card background color')"
                                    :placeholder="__('card background color')" required />


                            </div>

                            <div class="col-md-12">
                                <x-bs::input type="text" name="iframe_url" value="{{ $offer->iframe_url }}"
                                    :label="__('Offerwall URL')" required 
                                    placeholder="Ex:https://surveywall.wannads.com?apiKey=xxxxxxxx&userId=subId" 
                                    :title="__('Use subId as user identifier and the system will replace it.')"/>
                               
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                            <div class="col-md-6">
                                
                                <x-bs::input type="text" name="offer_params[response]" value="{{ $offer->offer_params->response }}" placeholder="ok"
                                    :label="__('Postback Response')" required  :title="__('some of offerwalls postack needs spacific response Ex: Ok OR 1')" />
                                
                                <x-bs::input type="text" name="offer_params[user_ident]" value="{{ $offer->offer_params->user_ident }}"
                                    required  :label="__('User identification parametar on postback url')" placeholder="subId" :title="__(
                                        'This is the unique identifier code of the user who completed action on your platform.',
                                    )" />
                               
                            </div>
                            <div class="col-md-6">

                                <x-bs::input type="text" name="offer_params[amount]" value="{{ $offer->offer_params->amount }}" :label="__('Rewards identification parametar on postback url')"
                                    placeholder="amount" required  :title="__('The rewards to be credited to your user.')" />
                               

                                <x-bs::input type="text" name="offer_params[trx]" value="{{ $offer->offer_params->trx }}" :label="__('The transaction identification parametar on postback url')"
                                    placeholder="transId" :title="__(
                                        'Unique identification code of the transaction made by your user on the platform.',
                                    )" required />
                               

                                <x-bs::input type="text" name="offer_params[server_ip]" value="{{ $offer->offer_params->server_ip }}" 
                                    :label="__('Whitelist Offerwall IP/IPs')" placeholder="0.0.0.0" :title="__(
                                        'Some of sites provides IPs to verify the request from them, If the more than one seperate them by comma.',
                                    )" />
                               
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                  <input type="checkbox" name="is_auto_pay" @if($offer->is_auto_pay) checked="checked" @endif />
                                  <label>Is Auto Pay</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                  <input type="checkbox" name="is_active" @if($offer->is_active) checked="checked" @endif />
                                  <label>Is Active</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                  <input type="checkbox" name="is_available" @if($offer->is_available) checked="checked" @endif />
                                  <label>Is Available</label>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $offer->id }}" />
                <input type="submit" value="Save" class="btn btn-primary mt-3" />
            </form>
        </div>
    </div>
@endsection
<x-js-notify />
<x-bootstrap-toggle />