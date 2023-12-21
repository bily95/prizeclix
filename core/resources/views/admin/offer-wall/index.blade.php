@extends('admin.layout.primary')
@section('title', __('Create Offerwall'))
@section('panel')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @lang('Create Offerwall')
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('moder.offer.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <x-bs::input type="file" name="image" :label="__('Offerwall Logo')" :placeholder="__('Offerwall Logo')" requirted accept=".png,.jpg"/>
                               
                            </div>
                            <div class="col-md-6">
                                <x-bs::input type="text" name="name"  :label="__('Offerwall Name')" value="{{ old('name') }}"
                                    :placeholder="__('Offerwall Name')" required/>
                            
                            </div>
                            <div class="col-md-6">
                                <x-bs::input type="color" name="bgcolor" value="{{ old('bgcolor') }}" :label="__('card background color')"
                                    :placeholder="__('card background color')" required />

                            </div>
                            <div class="col-md-12">
                                <x-bs::input type="text" name="iframe_url" 
                                    :label="__('Offerwall URL')" value="{{ old('iframe_url') }}"
                                    placeholder="Ex:https://surveywall.wannads.com?apiKey=xxxxxxxx&userId=subId" 
                                    :title="__('Use subId as user identifier and the system will replace it.')" required/>
                               
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                            <div class="col-md-6">
                                
                                <x-bs::input type="text" name="offer_params[response]" placeholder="ok" value="{{ old('offer_params.response') }}" required 
                                    :label="__('Postback Response')" :title="__('some of offerwalls postack needs spacific response Ex: Ok OR 1')" />
                                
                                <x-bs::input type="text" name="offer_params[user_ident]" value="{{ old('offer_params.user_ident') }}"  required 
                                    :label="__('User identification parametar on postback url')" placeholder="subId" :title="__(
                                        'This is the unique identifier code of the user who completed action on your platform.',
                                    )" />
                               
                            </div>
                            <div class="col-md-6">

                                <x-bs::input type="text" name="offer_params[amount]"  :label="__('Rewards identification parametar on postback url')"
                                value="{{ old('offer_params.amount') }}"  required  
                                placeholder="amount" :title="__('The rewards to be credited to your user.')" />
                               

                                <x-bs::input type="text" name="offer_params[trx]" :label="__('The transaction identification parametar on postback url')"
                                value="{{ old('offer_params.trx') }}" required 
                                    placeholder="transId" :title="__(
                                        'Unique identification code of the transaction made by your user on the platform.',
                                    )" />
                               
                                <x-bs::input type="text" name="offer_params[server_ip]" value="{{ old('offer_params.server_ip') }}"
                                    :label="__('Whitelist Offerwall IP/IPs')" placeholder="0.0.0.0" :title="__(
                                        'Some of sites provides IPs to verify the request from them, If the more than one seperate them by comma.',
                                    )" />
                               
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                  <input type="checkbox" name="is_auto_pay" @if(old('is_auto_pay')) checked="checked" @endif />
                                  <label>Is Auto Pay</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                  <input type="checkbox" name="is_active" @if(old('is_active')) checked="checked" @endif />
                                  <label>Is Active</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                  <input type="checkbox" name="is_available" @if(old('is_available')) checked="checked" @endif />
                                  <label>Is Available</label>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Save" class="btn btn-primary mt-3" />
            </form>
        </div>
    </div>
@endsection
<x-js-notify />
<x-bootstrap-toggle />