@extends('web.layouts.web')

@section('content')
    <div class="content-detail py-4">
        <div class="container">
            <div class="bg-white py-4 px-5">
                <h1 class="text-center">{{ $article->title }}</h1>
                <div class="show-content ck-content">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
        <div class="content-news-related mt-4">
            <div class="container">
                <div class="text-center">Bài viết liên quan</div>
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
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/news-detail.css') }}">
@endsection

@section('script')
    @parent
@endsection
