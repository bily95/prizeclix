<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include(SETTING['site_theme'] . 'partial.head')

    @stack('style')
</head>

<body class="ltr main-body app sidebar-mini dark-theme">

    <div id="global-loader">
        <div class="loader-content">
            <img src="{{ asset('/asset/theme/nova/img/loader.svg') }}"  alt="Loader">
            <img src="{{ asset('asset/uploads/setting/' . set('siteLoadingImage')) }}" class="animate__animated animate__heartBeat" alt="Loader" />
        </div>
    </div>
    @include(SETTING['site_theme'] . 'partial.header')
    @isset($slot)
        {{ $slot }}
    @else
        @yield('content')
    @endisset


    @include(SETTING['site_theme'] . 'addons.cookies')

    @include(SETTING['site_theme'] . 'partial.footer')
 
   
</body>

</html>
