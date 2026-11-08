<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Google Tag Manager owns the GA4 tag; avoid loading the same tag twice. -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NWSKF2CP');</script>
    <!-- End Google Tag Manager -->

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2172091253082286"
        crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Standard Favicon (ICO / PNG) -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16.png') }}">
    <!-- Apple Touch Icon (iOS Devices) -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">

    @yield('meta')
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', 'https://xconvertifire.com' . (rtrim(request()->getPathInfo(), '/') ?: '/'))">
    <!-- Bootstrap CSS -->
    <link href="{{ asset(request()->routeIs('home') ? 'assets/vendor/bootstrap-home.min.css' : 'assets/vendor/bootstrap-5.3.2.min.css') }}" rel="stylesheet">
    @include('components.style-links')
    <meta name="google-site-verification" content="1lIfyOhBm9UiZSK6O3WSAzfYT9h_L2ceRwixYlpsS6s" />
    <meta name="google-adsense-account" content="ca-pub-2172091253082286">
</head>

<body>

    @include('components.captcha')
    @include('components.navbar')
    @yield('content')
    @include('components.footer')
    @include('components.script-links')
    @yield('scripts')
</body>
</html>
