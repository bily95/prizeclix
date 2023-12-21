@extends( SETTING['site_theme'] . 'layouts.app')
@section('title', __('Shop Preview'))
@section('content')
    <div class="container card pt-100 pb-100" style="border-radius:20px;">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-deposit card">
                    <h5 class="text-center my-1">@lang('Current Balance') :
                        <strong>{{ showAmount(auth()->user()->balance) }} {{ __(GENERAL_SETTING['cur_text']) }}</strong>
                    </h5>
                    <div class="card-body mt-4">
                        <div class="container">
                            <div class="row" id="withdraw-preview-section">
                                <div class="col-12 mb-3">
                                    <div class="withdraw-details">
                                        <span class="font-weight-bold"><i class="fa fa-info-circle" style="color:#27ABE0"></i>&nbsp;&nbsp; @lang('Request Amount') :</span>
                                        <span class="font-weight-bold pull-right"> {{ showAmount($withdraw->amount) }}  {{ __(GENERAL_SETTING['cur_text']) }}</span>
                                    </div>
                                    <div class="withdraw-details">
                                        <span class="font-weight-bold"><i class="fa fa-info-circle"style="color:#27ABE0"></i>&nbsp;&nbsp; @lang('Withdrawal Charge') :</span>
                                        <span class="font-weight-bold pull-right">{{ showAmount($withdraw->charge) }} {{ __(GENERAL_SETTING['cur_text']) }}</span>
                                    </div>
                                    <div class="withdraw-details">
                                        <span class="font-weight-bold"><i class="fa fa-info-circle"style="color:#27ABE0"></i>&nbsp;&nbsp; @lang('After Charge') :</span>
                                        <span class="font-weight-bold pull-right">{{ showAmount($withdraw->after_charge) }}
                                            {{ __(GENERAL_SETTING['cur_text']) }}</span>
                                    </div>
                                    <div class="withdraw-details">
                                        <span class="font-weight-bold"><i class="fa fa-info-circle"style="color:#27ABE0"></i>&nbsp;&nbsp; @lang('Conversion Rate') : 1
                                            {{ __(GENERAL_SETTING['cur_text']) }} = </span>
                                        <span class="font-weight-bold pull-right"> {{ showAmount($withdraw->rate) }}
                                            {{ __($withdraw->currency) }}</span>
                                    </div>
                                    <div class="withdraw-details">
                                        <span class="font-weight-bold"><i class="fa fa-info-circle"style="color:#27ABE0"></i>&nbsp;&nbsp; @lang('You Will Get') :</span>
                                        <span class="font-weight-bold pull-right">{{ showAmount($withdraw->final_amount) }}
                                            {{ __($withdraw->currency) }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <form action="{{ route('user.withdraw.submit') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @if ($withdraw->method->user_data)
                                            @foreach ($withdraw->method->user_data as $k => $v)
                                                @if ($v->type == 'text')
                                                    <div class="form-group">
                                                        <label style="margin-left:10px;margin-bottom:10px"><strong>{{ __($v->field_level) }} @if ($v->validation == 'required')
                                                                    <span class="text-danger">*</span>
                                                                @endif
                                                            </strong></label>
                                                        <input type="text" name="{{ $k }}" class="form-control"
                                                            value="{{ old($k) }}"
                                                            placeholder="{{ __($v->field_level) }}"
                                                            @if ($v->validation == 'required') required @endif>
                                                        @if ($errors->has($k))
                                                            <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @elseif($v->type == 'textarea')
                                                    <div class="form-group">
                                                        <label><strong>{{ __($v->field_level) }} @if ($v->validation == 'required')
                                                                    <span class="text-danger">*</span>
                                                                @endif
                                                            </strong></label>
                                                        <textarea name="{{ $k }}" class="form-control"
                                                            placeholder="{{ __($v->field_level) }}" rows="3"
                                                            @if ($v->validation == 'required') required @endif>{{ old($k) }}</textarea>
                                                        @if ($errors->has($k))
                                                            <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @elseif($v->type == 'file')
                                                    <div class="form-group">
                                                        <div class="position-relative">
                                                            <input type="file" name="{{ $k }}" id="inputAttachments"
                                                                {{ $v->validation == 'required' ? 'required' : null }}
                                                                class="form-control custom--file-upload my-1" />
                                                            <label for="inputAttachments">{{ __($v->field_level) }}
                                                                @if ($v->validation == 'required')
                                                                    <span class="text-danger">*</span>
                                                                @endif
                                                            </label>
                                                        </div>
    
                                                        @if ($errors->has($k))
                                                            <br>
                                                            <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if (auth()->user()->ts)
                                            <div class="form-group">
                                                <label style="margin-top:10px;margin-bottom:5px;">@lang('Google Authenticator Code')</label>
                                                <input type="text" name="authenticator_code" class="form-control" required>
                                            </div>
                                        @endif
                                        <div class="form-group text-center">
                                            <button type="submit"
                                                class="btn btn-primary mt-2 text-center" style="box-shadow:none;">@lang('Confirm')</button>
                                        </div>
                                    </form>
                                </div>
                                 <div class="col-12">
                                    <p class="balance">@lang('Balance Will be') : {{ showAmount($withdraw->user->balance - $withdraw->amount) }}  {{ __(GENERAL_SETTING['cur_text']) }}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
