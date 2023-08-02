@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="container">
            <h1>Thực đơn</h1>
            <ul>
                @if(!empty($cats))
                    @forelse($cats as $k => $item)
                        <li>
                            <a href="{{ route('productCat', $item->slug) }}" title="{{ $item->title }}">{{ $item->title }}</a>
                        </li>
                    @empty
                    @endforelse
                @endif
            </ul>
        </div>
    </div>
    <div class="list-news-home">
        <div class="container">
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
            {{ $products->links('web.components.pagination') }}
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
