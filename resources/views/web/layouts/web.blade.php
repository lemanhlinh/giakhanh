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
    </div>
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('/css/web/style.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/web/main.js') }}" defer></script>
@endsection
