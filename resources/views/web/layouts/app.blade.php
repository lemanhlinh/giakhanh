<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link type='image/x-icon' href='{{ asset('images/favicon.ico') }}' rel='icon'/>
    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('link')
</head>
<body>
    @yield('page')
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- Scripts -->
    @yield('script')
</body>
</html>
