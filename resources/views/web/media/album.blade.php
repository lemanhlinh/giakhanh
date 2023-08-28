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
            <div class="row g-0 mg-for-article" id="category-list">
                @foreach($images as $k => $item)
                    <div class="col-md-4 position-relative">
                        <div class="article-item">
                            <div class="article-item-content" data-category="category-{{ $item->id }}">
                                <span>
                                    @include('web.components.image', ['src' => $item->image_resize['resize'], 'title' => $item->title])
                                </span>
                                <div class="box-content-article">
                                    <h4 class="title-article">{{ $item->title }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $images->links('web.components.pagination') }}
            <div id="image-gallery">
                @foreach($images as $k => $item)
                    @foreach($item->mediaImages as $k => $data)
                    <a href="{{ asset($data->image) }}" data-category="category-{{ $item->id }}" style="display: none">
                        @include('web.components.image', ['src' => $data->image, 'title' => $item->title])
                    </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/lightgallery-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/web/album-home.css') }}">
@endsection

@section('script')
    @parent
    <script src="{{ asset('js/lightgallery.min.js') }}"></script>
    <script>
        $('#category-list .article-item-content').click(function() {
            var category = $(this).data('category');
            $('#image-gallery').show();
            $('#image-gallery a').hide();
            $('#image-gallery a[data-category="' + category + '"]').show();
            $('#image-gallery').lightGallery();
        });
    </script>
@endsection
