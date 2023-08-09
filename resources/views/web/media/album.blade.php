@extends('web.layouts.web')

@section('content')
    <div class="top-content-media">
        <div class="container">
            <h1 class="title-page">Thư viện</h1>
            <ul class="list-menu-page list-unstyled">
                <li>
                    <a href="{{ route('album') }}" class="active">Hình ảnh</a>
                </li>
                <li>
                    <a href="{{ route('video') }}">Video</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <div class="row g-0 mg-for-article">
                @foreach($images as $k => $item)
                    <div class="col-md-4 position-relative">
                        <div class="article-item">
                            <div class="article-item-content">
                                <a href="#">
                                    @include('web.components.image', ['src' => $item->image, 'title' => $item->title])
                                </a>
                                <div class="box-content-article">
                                    <a href="#">
                                        <h4 class="title-article">{{ $item->title }}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
{{--            {{ $images->links('web.components.pagination') }}--}}
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/album-home.css') }}">
@endsection

@section('script')
    @parent
@endsection
