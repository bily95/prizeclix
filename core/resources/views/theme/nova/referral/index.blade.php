@extends(SETTING['site_theme'] . 'layouts.app')
@section('title', 'Referrals')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">statistics</h5>
                    <div class="d-flex">
                        <div class="panel text-center me-2 p-3 border-white border">
                            <h6 class="panel-title">Total Referrals</h6>
                            <p>{{ showAmount($totalReferrals, 0) }}</p>
                        </div>
                        <div class="panel text-center me-2 p-3 border-white border">
                            <h6 class="panel-title">Total Commission</h6>
                            <p>{{ showAmount($totalCommission, 0) }}{{ GENERAL_SETTING['cur_sym'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="card text-center" id="referrallinkcommition">
        <div class="card-body text-center">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center">@lang('YOUR REFERRAL LINK')</h4>

                    <div class="form-group">
                        <div class="input-group input-group w-75 mx-auto mb-3">
                            <input type="text" id="reflink" value="{{ $userRefLink }}"
                                class="form-control m-0 rounded-0" readonly>
                            <span class="input-group-text bg-primary copytext" id="copyBoard" role="button">
                               <i class="fas fa-link"></i> Copy Link
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="share-icons">
                        <p class="bp-0 mb-0">share your referral link</p>
                        <div id="share-icons-holder"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-tit">
                Commission history
            </h5>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <x-table :th="['#', 'from', 'amount', 'date']">
                        @foreach ($commissions as $index => $log)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $log->bywho ? $log->bywho->username : 'Deleted Account' }}</td>
                                <td>{{ showAmount($log->amount) }}{{ GENERAL_SETTING['cur_sym'] }}</td>
                                <td>{{ showDateTime($log->created_at,'y-m-d') }}
                                    <br> {{ diffForHumans($log->created_at) }}
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                    {{ $commissions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
<x-js-notify />
@push('script')
    <script>
        (function($) {
            "use strict";

            $('.copytext').on('click', function() {
                var copyText = document.getElementById("reflink");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                notify('info', 'Link Copied!');
            });
        })(jQuery);
    </script>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('/asset/static/social-share/jssocials.css') }}">
    <link rel="stylesheet" href="{{ asset('/asset/static/social-share/jssocials-theme-flat.css') }}">
@endpush
@push('script')
    <script src="{{ asset('/asset/static/social-share/jssocials.min.js') }}"></script>
    <script>
        (function($) {
            $('#share-icons-holder').jsSocials({
                shares: ["twitter", "facebook", {
                    share: "telegram",
                    logo: "fab fa-telegram"
                }, "whatsapp", {
                    share: "email",
                    logo: "fas fa-envelope"
                }, "linkedin", "pinterest"],
                showLabel: false,
                showCount: false,
                url: "{{ $userRefLink }}",
                text: "{{ SETTING['siteName'] . '|' . SETTING['siteMetaDescription'] }}",
                shareIn: "popup",

            });
        })(jQuery);
    </script>
@endpush
