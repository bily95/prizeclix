@extends('admin.layout.primary')
@section('title', 'Referral System ')

@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <h5 class="card-header">@lang('Earning Commissions')
                    @if (GENERAL_SETTING['wc'] == 0)
                        <span class="badge bg-danger float-end">@lang('Disabled')</span>
                    @else
                        <span class="badge bg-success float-end">@lang('Enabled')</span>
                    @endif
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (GENERAL_SETTING['wc'] == 0)
                                <a href="{{ route('moder.referral.status', 'wc') }}"
                                    class="btn btn-primary">@lang('Enable Now')</a>
                            @else
                                <a href="{{ route('moder.referral.status', 'wc') }}"
                                    class="btn btn-danger btn-sm mb-3">@lang('Disable Now')</a>
                            @endif
                        </div>
                    </div>
                    <x-table :th="['Level', 'Users', 'commission']">
                        @foreach ($trans->where('commission_type', 'win') as $key => $p)
                        <tr>
                            <td data-label="Level">@lang('LEVEL')# {{ $p->level }}</td>
                            <td data-label="required">@lang('Required') => {{ $p->required }}
                                @lang('Users')</td>
                            <td data-label="Commission">{{ $p->percent }} %</td>
                        </tr>
                    @endforeach
                    </x-table>

                    <hr>

                    <div class="row mt-3 mb-5">
                        <div class="col-md-6 mb-3">
                            <input type="number" name="level" placeholder="@lang('HOW MANY LEVELS')"
                                class="form-control input-lg levelGenerate">
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success btn-sm generate">
                                @lang('GENERATE')
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('moder.store.refer') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="commission_type" value="win">
                        <div class="d-none levelForm">
                            <div class="form-group">
                                <label class="text-success"> @lang('Level & Commission :')
                                    <small>@lang('(Old Levels will Remove After Generate)')</small>
                                </label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="description referral-desc">
                                            <div class="row">
                                                <div class="col-md-12 planDescriptionContainer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block my-3">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-js-notify />
@push('script')
    <script>
        $(document).ready(function() {
            "use strict";

            var max = 1;
            $(document).ready(function() {
                $(".generate").on('click', function() {

                    var levelGenerate = $('.levelGenerate').val();
                    var a = 0;
                    var val = 1;
                    var viewHtml = '';
                    if (levelGenerate !== '' && levelGenerate > 0) {
                        $('.levelForm').removeClass('d-none');
                        $('.levelForm').addClass('d-block');

                        for (a; a < parseInt(levelGenerate); a++) {
                            viewHtml += `<div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text no-right-border">LEVEL</span>
                            </div>
                            <input name="level[]" class="form-control margin-top-10 no-left-border width-120" type="number" readonly value="${val++}" required placeholder="Level">
                            <input name="required[]" class="form-control margin-top-10" type="text" required placeholder="@lang('Required')">
                            <input name="percent[]" class="form-control margin-top-10" type="text" required placeholder="@lang('Percentage %')">
                            <span class="input-group-btn">
                            <button class="btn btn-danger btn-sm margin-top-10 delete_desc" type="button"><i class='fa fa-times'></i></button></span>
                            </div>`;
                        }
                        $('.planDescriptionContainer').html(viewHtml);

                    } else {
                        alert('Level Field Is Required');
                    }
                });

                $(document).on('click', '.delete_desc', function() {
                    $(this).closest('.input-group').remove();
                });
            });


        });
    </script>
@endpush
