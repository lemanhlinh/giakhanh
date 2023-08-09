@extends('web.layouts.web')

@section('content')
    <div class="top-content-media">
        <div class="container">
            <h1 class="title-page">hệ thống cửa hàng</h1>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {!! $setting['map_contact'] !!}
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/store-home.css') }}">
@endsection

@section('script')
    @parent
@endsection
