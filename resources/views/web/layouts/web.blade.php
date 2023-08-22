@extends('web.layouts.app')
@section('page')
    <div id="app">
        <!-- Header -->
        @include('web.partials._header')
        <!-- /.Header -->
        <div class="content">
            @yield('content')
        </div>
        <!-- Main Footer -->
        @include('web.partials._footer')
        @include('web.partials._offcanvas')
    </div>
    <nav class="menu-mobile d-block d-md-none" id="menu-mobile">
        <ul>
            @if(!empty($menus))
                @foreach ($menus as $shop)
                    @include('web.components.menu.mobile', ['item'=>$shop])
                @endforeach
            @endif
        </ul>
    </nav>
@endsection

@section('link')
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/web/style.css') }}">
@endsection

@section('script')
    <!-- Bootstrap -->
    <script src="{{ asset('/js/web/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/web/main.js') }}" defer></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="yQawsNWn"></script>
@endsection
