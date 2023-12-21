<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="shortcut icon" href="{{ asset('asset/uploads/setting/' . SETTING['siteFaviconImage']) }}" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- SEO Meta --}}
<meta name="description" content="{{ SETTING['siteMetaDescription'] }}" />
<meta name="keywords" content="{{ SETTING['siteMetaKeywords'] }}" />

{{-- Social Meta --}}
<!--  Essential META Tags -->
<meta property="og:title" content="{{ SETTING['siteName'] }}">
<meta property="og:description" content="{{ SETTING['siteMetaDescription'] }}">
<meta property="og:image" content="{{ asset('asset/uploads/setting/' . SETTING['siteSocialImage']) }}">
<meta property="og:url" content="{{ url('/') }}">
<meta name="twitter:card" content="summary_large_image">

<!--  Non-Essential, But Recommended -->
<meta property="og:site_name" content="{{ SETTING['siteName'] }}">
<meta name="twitter:image:alt" content="Alt text for image">

<!--  Non-Essential, But Required for Analytics -->
<meta property="fb:app_id" content="{{ SETTING['siteName'] }}" />
<meta name="twitter:site" content="{{ '@' . SETTING['siteName'] }}">

<title>
    @if (View::hasSection('title'))
        @yield('title')
    @else
        @if (Auth::check())
            @if (is_null(request()->segment(count(request()->segments()))))
                {{ SETTING['siteMetaDescription'] }} | {{ SETTING['siteName'] }}
            @else
                {{ ucwords(request()->segment(count(request()->segments()))) }} | {{ SETTING['siteName'] }}
            @endif
        @else
            {{ SETTING['siteName'] }} | {{ SETTING['siteMetaDescription'] }}
        @endif
    @endif
</title>

{{-- Insert Custom CSS --}}
@stack('style')

{{-- Layout  ASSETS --}}
<link rel="stylesheet" href="{{ asset('/asset/theme/nova/css/icons.css') }}" />
<link rel="stylesheet" href="{{ asset('asset/theme/nova/css/app.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/asset/static/app/css/style.css?v=' . filemtime('asset/static/app/css/style.css')) }}" />


{{-- Livewire Assets --}}
@livewireStyles

@if (!is_local())
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-{{ set('googleAnalysis') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-{{ set('googleAnalysis') }}');
    </script>
@endif

{{-- Jquery Library --}}
<script src="{{ asset('/asset/static/app/js/jquery.min.js') }}"></script>
