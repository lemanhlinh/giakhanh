@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <p>Tin công nghệ</p>
                     <h1>Nơi cập nhật tin tức
                         công nghệ mới nhất</h1>
                    <span>Thông tin công nghệ thiết kế App mobile về điện thoại di động, máy tính bảng, laptop mới nhất được cập nhật hằng giờ. Tin về sản phẩm mới mắt, đánh giá sản phẩm, ...</span>
                </div>
                <div class="col-md-7">
                    <img src="{{ asset('images/news-final.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <div class="row">
                @foreach($article as $k => $item)
                    <div class="col-md-4 position-relative">
                        <img src="{{ asset($item->image) }}" alt="" class="img-fluid">
                        <div class="title-new">
                            <p>Thứ bảy, 27/11/2021 06:00 (GMT+7)</p>
                            <h4>{{ $item->title }}</h4>
                        </div>
                        <a href="{{ route('detailArticle',['slug' => $item->slug,'id' => $item->id]) }}" class="stretched-link"></a>
                    </div>
                @endforeach
            </div>
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
