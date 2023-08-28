@extends('web.layouts.web')

@section('content')
    <div class="top-content-media">
        <div class="container">
            <h1 class="title-page">Thư viện</h1>
            <ul class="list-menu-page list-unstyled">
                <li>
                    <a href="{{ route('album') }}" >Hình ảnh</a>
                </li>
                <li>
                    <a href="{{ route('video') }}" class="active">Video</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <div class="row g-0 mg-for-article">
                @foreach($videos as $k => $item)
                    <div class="col-md-4 position-relative">
                        <div class="article-item">
                            <div class="article-item-content">
                                <a href="#" class="image-video">
                                    @include('web.components.image', ['src' => $item->image_resize['resize'], 'title' => $item->title])
                                    <img src="{{ asset('images/Youtube.png') }}" alt="" class="play-youtube-video  top-50 start-50 translate-middle">
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
            {{ $videos->links('web.components.pagination') }}
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
