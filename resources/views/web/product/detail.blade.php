@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @include('web.components.image', ['src' => $product->image, 'title' => $product->title])
                </div>
                <div class="col-md-6">
                    {!! $product->content_include !!}
                </div>
            </div>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
            <h4>Các món khác</h4>
            <div class="row">
                @if(!empty($products))
                    @forelse($products as $k => $item)
                        <div class="col-md-4">
                            <a href="{{ route('productDetail',['slugCat'=>$cat->slug,'slug'=>$item->slug]) }}" title="{{ $item->title }}">
                                @include('web.components.image', ['src' => $item->image, 'title' => $item->title])
                                <h4>{{ $item->title }}</h4>
                            </a>
                            <p>{{ $item->price }}</p>
                        </div>
                    @empty
                    @endforelse
                @endif
            </div>
            <h4>các món gọi thêm</h4>
            <div class="row">
                @if(!empty($products))
                    @forelse($products as $k => $item)
                        <div class="col-md-4">
                            <a href="{{ route('productDetail',['slugCat'=>$cat->slug,'slug'=>$item->slug]) }}" title="{{ $item->title }}">
                                @include('web.components.image', ['src' => $item->image, 'title' => $item->title])
                                <h4>{{ $item->title }}</h4>
                            </a>
                            <p>{{ $item->price }}</p>
                        </div>
                    @empty
                    @endforelse
                @endif
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
