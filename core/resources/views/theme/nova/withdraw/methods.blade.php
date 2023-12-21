@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', __('Shop '))
@section('content')

    <div class="card">
        <div class="card-body ">

            @if (GENERAL_SETTING['withdraw_status'] == 0)
                <div class="row justify-content-center ">
                    <div class="col-xl-7 col-md-8 col-sm-9 col-10">
                        <div class="checkout-banner">
                            <p class="checkout-text">WE'RE OUT OF STOCKS NOW,COME BACK LATER!</p>
                        </div>
                    </div>
                </div>
            @endif




            <div class="mb-2">
                <div class="float-start">
                    <h2 class="hdue"><i class="fas fa-car-crash"></i> Shop</h2>
                    <p class="paraff">Exchange your coins in cash or crypto and receive it within minutes!</p>
                </div>
                <div class="float-end">
                    <a href="{{ route('user.withdraw.history') }}" class="btn btn-primary">
                        @lang('History')
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div class="">
                
                        @foreach ($withdrawMethod->groupBy('category') as $category => $methods)
                            <h5 class="text-mute text-uppercase mt-3">Withdraw {{ $category }}</h5>
                            <div class="row">
                                @foreach ($methods as $data)
                                    <div class="col-lg-3 col-md-4 mb-3 col-6">
                                        <div class="offerwallsposition custom-style-cashout"
                                            style="background: {{ $data->bgcolor }};height:90px">
                                            <a href="javascript:void(0)" data-id="{{ $data->id }}"
                                                data-resource="{{ $data }}"
                                                data-min_amount="{{ showAmount($data->min_limit) }}"
                                                data-max_amount="{{ showAmount($data->max_limit) }}"
                                                data-fix_charge="{{ showAmount($data->fixed_charge) }}"
                                                data-percent_charge="{{ showAmount($data->percent_charge) }}"
                                                data-base_symbol="{{ __(GENERAL_SETTING['cur_text']) }}" data-bs-toggle="modal"
                                                data-bs-target="#withdrawModal" 
                                                class="withdraw"
                                                style="height: 90px;">
                                                <img
                                                    src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $data->image, imagePath()['withdraw']['method']) }}" />

                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                   
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('user.withdraw.money') }}" method="post">
                    <h5 class="text-center">@lang('Withdraw')</h5>
                    <div id="withdrawImage_wrapper" class="p-5 text-center">
                        <img id="withdrawImage" height="100px" width="100%" />
                    </div>
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency form-control">
                            <input type="hidden" name="method_code" class="edit-method-code  form-control">
                        </div>


                        <div class="form-group">
                            <label>@lang('Enter Amount')</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control form-control-lg"
                                    onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount"
                                    placeholder="0.00 {{ __(GENERAL_SETTING['cur_text']) }}" required=""
                                    value="{{ old('amount') }}" class="paraff">

                                <!--<span class="input-group-text addon-bg currency-addon">{{ __(GENERAL_SETTING['cur_text']) }}</span>-->
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="charges">
                                <p class="paraff"> <i class="fas fa-icons"></i>&nbsp;&nbsp; Minimum <span
                                        id="minWithdrawLimit">0</span> <span>{{ GENERAL_SETTING['cur_text'] }}</span></p>
                                <p class="paraff"> <i class="fas fa-icons"></i>&nbsp;&nbsp; Maximum <span
                                        id="maxWithdrawLimit">0</span> <span>{{ GENERAL_SETTING['cur_text'] }}</span></p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">@lang('Confirm')</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Cancel')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<x-js-notify />
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.withdraw').on('click', function() {
                var id = $(this).data('id');
                var result = $(this).data('resource');

                var imagePath = '{{ asset('/asset/uploads/withdraw/method') }}/' + result.image;


                $("#withdrawImage").attr('src', imagePath);
                $("#withdrawImage_wrapper").css('background', result.bgcolor);

                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');


                $("#minWithdrawLimit").text(minAmount);
                $("#maxWithdrawLimit").text(maxAmount);

                var withdrawLimit =
                    `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  {{ __(GENERAL_SETTING['cur_text']) }}`;
                $('.withdrawLimit').text(withdrawLimit);

                var withdrawCharge =
                    `@lang('Charge'): ${fixCharge} {{ __(GENERAL_SETTING['cur_text']) }} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
                $("#withdrawModal").modal('show');
            });
        })(jQuery);
    </script>
@endpush
