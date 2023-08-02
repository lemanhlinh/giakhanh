@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="container">
            <h1>Hình ảnh</h1>
            <ul>
                <li>
                    <a href="{{ route('album') }}">Hình ảnh</a>
                </li>
                <li>
                    <a href="{{ route('video') }}">Video</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <div class="row">
                @foreach($images as $k => $item)
                    <div class="col-md-4 position-relative">
                        <img src="{{ isset($item->image)?asset($item->image):'' }}" alt="" class="img-fluid">
                        <div class="title-new">
                            <p>Thứ bảy, 27/11/2021 06:00 (GMT+7)</p>
                            <h4>{{ $item->title }}</h4>
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
    <link rel="stylesheet" href="{{ asset('/css/web/news-home.css') }}">
@endsection

@section('script')
    @parent
@endsection
