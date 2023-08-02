@extends('web.layouts.web')

@section('content')
    <div class="content-detail">
        <div class="image-banner">
            @include('web.components.image', ['src' => rawurldecode($page->image_title), 'title' => $page->title])
        </div>
        <div class="container">
            <div class="box-content-detail">
                <div class="show-content ck-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/page-home.css') }}">
@endsection

@section('script')
    @parent
@endsection
