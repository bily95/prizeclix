</div>
</div>
{{-- Footer --}}
<div id="UserPublicProfile"></div>
<footer class="footer main-footer">
    @guest
        <div class="container pb-1">
            <div class="row">
                <div class="col-xl-3 col-md-4 col-6">
                    <img src="{{ asset('/asset/uploads/setting/' . SETTING['siteLogoImage']) }}">
                    <a href="https://play.google.com/store/apps/details?id=com.{{ SETTING['siteName'] }}.twa" target="_blank">
                        <i class="fas fa-google-play"></i>
                    </a>
                </div>
                <div class="col-xl-3 col-md-4 col-6">
                    <div class="widget my-2">
                        <h4 class="hdue">About US:</h4>
                        <div class="links-group">
                            <a href="{{ route('faq') }}" class="footer-link mt-2" class="paraff">
                                <i class="fas fa-question-circle"></i>
                                Faq
                            </a>
                            <a href="{{ route('tos') }}" class="footer-link mt-2" class="paraff">
                                <i class="fas fa-info-circle"></i>
                                Terms of Service
                            </a>
                            <a href="{{ route('policy') }}" class="footer-link mt-2" class="paraff">
                                <i class="fas fa-info-circle"></i>
                                Privacy Policy
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6">
                    <div class="widget my-2">
                        <h4 class="hdue">Support</h4>
                        <div class="links-group">
                            <a href="mailto:support@{{ SETTING['siteName'] }}.com" class="footer-link mt-2">
                                <i class="fas fa-envelope"></i>
                                Contact
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-4 col-6">
                    <div class="widget my-2">
                        <h4 class="hdue">Social:</h4>
                        <div class="links-group">
                            <a href="https://www.trustpilot.com/review/{{ SETTING['siteName'] }}.com" target="_blank" class="footer-link mt-2">
                                <i class="fas fa-star"></i>
                                Trustpilot
                            </a>
                            <a href="https://t.me/{{ SETTING['siteName'] }}" target="_blank" class="footer-link mt-2">
                                <i class="fab fa-telegram"></i>
                                Telegram
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
    <div class="container">
        <div class="copy-right mt-2 text-center">
            <p style="letter-spacing:3px;opacity: .8;font-size: 10px;">@lang('All Rights Reserved') &copy;{{ date('Y') }}
                {{ SETTING['siteName'] }}</p>
        </div>
    </div>
</footer>
<div class="mobile_nav">
    <ul class="mobile_nav-manu">
        <li class="mobile_nav-item">
            <a class="mobile_nav-link" href="{{ route('user.leaderboard') }}">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"></path><path d="M7.5 21H2V9h5.5v12zm7.25-18h-5.5v18h5.5V3zM22 11h-5.5v10H22V11z"></path></svg>
            Ranking</a>
        </li>
        <li class="mobile_nav-item">
            <a class="mobile_nav-link" href="{{ route('user.withdraw') }}">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"></path><path d="M19 14V6c0-1.1-.9-2-2-2H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zm-9-1c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm13-6v11c0 1.1-.9 2-2 2H4v-2h17V7h2z"></path></svg>
            Cashout</a>
        </li>
        <li class="mobile_nav-item mobile_nav-middle">
            <a class="mobile_nav-link" href="{{ route('user.home') }}">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M225.814 32.316c-3.955-.014-7.922-.01-11.9.007-19.147.089-38.6.592-58.219 1.32l5.676 24.893c20.431-2.31 42.83-4.03 65.227-4.89 12.134-.466 24.194-.712 35.892-.65 35.095.183 66.937 3.13 87.77 11.202l8.908 3.454-3.977 8.685c-29.061 63.485-35.782 124.732-31.228 184.826 2.248-71.318 31.893-134.75 70.81-216.068-52.956-8.8-109.634-12.582-168.959-12.78zm28.034 38.79c-8.74.007-17.65.184-26.559.526-41.672 1.6-83.199 6.49-110.264 12.096 30.233 56.079 54.69 112.287 70.483 167.082a71.934 71.934 0 0 1 5.894.045c4.018.197 7.992.742 11.875 1.59-16.075-51.397-34.385-98.8-57.146-146.131l-5.143-10.694 11.686-2.068c29.356-5.198 59.656-7.21 88.494-7.219 1.922 0 3.84.007 5.748.024 18.324.16 35.984 1.108 52.346 2.535l11.054.965-3.224 10.617c-18.7 61.563-22.363 127.678-11.79 190.582.176.163.354.325.526.49 3.813-1.336 7.38-2.698 10.705-4.154-8.254-67.394-4.597-136.923 26.229-209.201-17.202-4.383-43.425-6.674-72.239-7.034a656.656 656.656 0 0 0-8.675-.05zm144.945 7.385c-30.956 65.556-52.943 118.09-56.547 174.803 20.038-66.802 58.769-126.685 102.904-165.158a602.328 602.328 0 0 0-46.357-9.645zM103.832 97.02c-18.76 3.868-37.086 8.778-54.812 15.562 8.626 7.48 24.22 21.395 43.14 39.889 8.708-8.963 17.589-17.818 26.852-25.87a1067.587 1067.587 0 0 0-15.18-29.581zm142.023 7.482c-13.62-.066-27.562.324-41.554 1.293-1.468 13.682-9.56 26.482-19.225 39.07 15.431 36.469 28.758 73.683 40.756 113.194 18.375 5.42 36.554 11.827 51.28 19.504-5.47-42.458-4.722-85.963 2.38-128.508-12.885-13.31-19.597-28.09-20.135-44.34a621.48 621.48 0 0 0-13.502-.213zm182.018 26.985c-24.73 29.3-46.521 65.997-61.37 105.912 27.264-38.782 60.79-69.032 96.477-90.4a1318.664 1318.664 0 0 0-35.107-15.512zm-300.74 11.959c-14.594 13.188-29.014 29.017-44.031 44.097 32.289 19.191 59.791 41.918 82.226 67.66 1.393-.526 2.8-.999 4.215-1.43-10.498-36.096-24.885-73.033-42.41-110.327zM360.52 268.198c-16.397 19.788-31.834 30.235-53.09 38.57 2.391 9.22-1.16 19.805-9.334 27.901-4.808 4.761-10.85 10.188-19.684 13.715a62.896 62.896 0 0 0 3.9 2.127c12.364 6.17 34.207 4.18 54.5-5.049 20.23-9.2 38.302-25.092 45-41.191 3.357-9.05.96-13.77-4.917-20.692-4.184-4.925-10.295-9.89-16.375-15.38zm-170.079.586c-10.715-.098-21.597 2.994-30.59 9.76-12.79 9.623-22.65 26.784-22.738 55.934v.2l-.01.2c-2.92 61.381 1.6 89.7 10.555 105.065 7.904 13.562 21.05 20.054 40.28 31.994.916-2.406 1.87-5.365 2.765-9.098 2.277-9.499 4.161-22.545 5.355-36.975 2.389-28.858 2.04-63.51-1.955-88.445l-2.111-13.19 13.016 2.995c31.615 7.273 49.7 8.132 60.2 6.28 10.502-1.854 14.061-5.523 20.221-11.624 5.79-5.732 5.682-7.795 4.456-11.021-1.227-3.227-6.149-8.545-14.5-13.633-16.703-10.176-45.085-19.611-71.614-26.647a53.988 53.988 0 0 0-13.33-1.795zm189.1 69.416c-10.013 9.754-22.335 17.761-35.277 23.647-20.983 9.542-44.063 13.907-63.211 7.553-6.76 2.516-10.687 5.407-12.668 7.8-2.718 3.284-2.888 5.7-1.967 9.16.92 3.46 3.665 7.568 7.059 10.524 3.393 2.956 7.426 4.492 8.959 4.564 46.794 2.222 67.046-11.207 92.277-26.783 7.358-4.542 10.174-13.743 9.469-22.931-.353-4.594-1.69-8.911-3.233-11.63a9.009 9.009 0 0 0-1.408-1.904zm-166.187 9.096c2.727 25.068 2.772 54.314.642 80.053-1.247 15.072-3.175 28.779-5.789 39.685-1.137 4.746-2.388 8.954-3.9 12.659l146.697-6.465c-1.656-6.149-3.344-12.324-5.031-18.502a127.004 127.004 0 0 1-17.24 4.424l.044.73-8.316.518c-5.121.614-10.452.953-15.983.992l-83.86 5.21 2.493-11.607c7.947-37.006 8.68-69.589 3.778-105.234a353.433 353.433 0 0 1-13.536-2.463zm31.972 4.684c3.948 31.933 3.473 62.41-2.406 95.2l19.264-1.196a39.44 39.44 0 0 1-6.1-14.778c-1.296-6.88-.575-14.538 3.926-20.87.199-.281.414-.55.627-.821-5.246-4.845-9.628-11.062-11.614-18.524-2.114-7.944-.794-17.67 5.497-25.27 2.079-2.51 4.592-4.776 7.543-6.816-2.61-2.08-4.898-4.285-6.874-6.582-3.064.021-6.345-.093-9.863-.343zm132.666 41.785c-23.456 14.253-49.81 27.876-96.41 25.664a26.402 26.402 0 0 1-4.518-.615c-1.233.553-1.891 1.256-2.382 1.947-.963 1.355-1.532 3.8-.909 7.113 1.248 6.627 7.525 13.889 13.37 14.569 41.385 4.813 69.979-8.726 87.341-24.477 8-7.258 8.068-11.9 6.89-16.951-.59-2.523-1.89-4.969-3.382-7.25zm-6.683 49.062a114.657 114.657 0 0 1-8.547 4.86c1.65 6.051 3.304 12.102 4.937 18.154l19.92-3.572c-5.14-4.387-9.162-8.954-12.39-13.496-1.442-2.029-2.713-4.001-3.92-5.946z"></path></svg>
            Earn</a>
        </li>
        <li class="mobile_nav-item">
            <a class="mobile_nav-link" href="{{ auth()->check() ? '#' : route('user.login') }}" @auth
                onclick="openDailyTasks()" @endauth>
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M305.975 298.814l22.704 2.383V486l-62.712-66.965V312.499l18.214 8.895zm-99.95 0l-22.716 2.383V486l62.711-66.965V312.499l-18.213 8.895zm171.98-115.78l7.347 25.574-22.055 14.87-1.847 26.571-25.81 6.425-10.803 24.314-26.46-2.795-18.475 19.087L256 285.403l-23.902 11.677-18.475-19.15-26.46 2.795-10.803-24.313-25.81-6.363-1.847-26.534-22.118-14.92 7.348-25.573-15.594-21.544 15.644-21.52-7.398-25.523 22.068-14.87L150.5 73.03l25.86-6.362 10.803-24.313 26.46 2.794L232.098 26 256 37.677 279.902 26l18.475 19.149 26.46-2.794 10.803 24.313 25.81 6.425 1.847 26.534 22.055 14.87-7.347 25.574 15.656 21.407zm-49.214-21.556a72.242 72.242 0 1 0-72.242 72.242 72.355 72.355 0 0 0 72.242-72.242zm-72.242-52.283a52.282 52.282 0 1 0 52.282 52.283 52.395 52.395 0 0 0-52.282-52.245z"></path></svg>
            Rewards</a>
        </li>
        <li class="mobile_nav-item">
            <a class="mobile_nav-link" href="#!" onclick="toggleChat()">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="left-menu-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M4 18h2v4.081L11.101 18H16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2z"></path><path d="M20 2H8c-1.103 0-2 .897-2 2h12c1.103 0 2 .897 2 2v8c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"></path></svg>
            Chat</a>
        </li>
    </ul>
</div>
@if (Route::has('dailytasks') && auth()->check())
    @include('dailytasks::holder')
@endif
{{-- End of Footer --}}
<div id="back-to-top" role="button">
    <i class="fas fa-arrow-up"></i>
</div>
{{-- Scripts and libraries --}}
<script src="{{ asset('/asset/theme/nova/js/app.min.js') }}"></script>

{{-- Switch Language --}}
<script>
    $(document).ready(function() {
        $(document).on('change', '#langSel', function() {
            var code = $(this).val();
            window.location.href = "{{ url('/') }}/change-lang/" + code;
        });

        $('#global-loader').fadeOut('1000');
    });
</script>

{{-- Livewire Scripts --}}
@livewireScripts
<script>
    function toggleChat() {
        Livewire.emit('toggleChat');
    }
    @if (is_local() == false)
        window.livewire.onError(statusCode => {
            return false;
        })
    @endif
    @auth()
        function showUserBalanceInDollar() {
            if ($('#flexSwitchCheckDefault').is(':checked')) {
                $('#userHeaderBalance').text('{{ '$' . showAmount(auth()->user()->balance / GENERAL_SETTING['cur_rate'], 0) }}');
            } else {
                $('#userHeaderBalance').text('{{ GENERAL_SETTING['cur_sym'] }}{{ showAmount(auth()->user()->balance, 0) }}');
            }
        }
    @endauth
</script>
<script>
    $(document).ready(function() {
      
        $.ajax({
            type: "GET",
            dataType: "Json",
            url: "{{ route('api.load-sidebar-category') }}",
            success: function(res) {
                $(".load-category").html(res.html);
            }
        });

    })
</script>

<script>
    function UserPublicProfile($userId)
    {

        return;

        $.ajax({
            url:"{{ route('userPublicProfile') }}",
            data:{
                userId:$userId,
            },
            success:function(res){
                $('#UserPublicProfile').html(res);
                $('.modal#userPublicProfileModal').modal('show')
            },
            error:function(er){
                console.log(er);
            }
        });
    }
</script>

{{-- Insert pages javascripts --}}
@stack('script')
