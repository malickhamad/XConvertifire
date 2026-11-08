    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/vendor/inter.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset(request()->routeIs('home') ? 'assets/vendor/fontawesome-home.min.css' : 'assets/vendor/fontawesome-6.4.0.min.css') }}">
    <!-- AOS Animation CSS -->
    <link rel="preload" href="{{ asset('assets/vendor/aos-2.3.1.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="{{ asset('assets/vendor/aos-2.3.1.css') }}" rel="stylesheet"></noscript>

    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}?v={{ filemtime(public_path('assets/css/style.min.css')) }}">

    @if (request()->routeIs('contact', 'contact.store'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif
