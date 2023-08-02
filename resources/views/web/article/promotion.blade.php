@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="container">
            <h1>Ưu đãi nổi bật</h1>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <div class="row">
                @foreach($articles as $k => $item)
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
            {{ $articles->links('web.components.pagination') }}
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
