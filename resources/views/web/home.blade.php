@extends('web.layouts.web')

@section('content')
    <div class="top-content">
        <div class="slide-home">
            @forelse($slider as $item)
                @include('web.components.image', ['src' => $item->image_resize['lager'], 'title' => $item->title])
            @empty
            @endforelse
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="slider-nav-slide-home">
                        @foreach($slider as $item)
                            <div class="img-slide-item">
                                @include('web.components.image',['src' => $item->image_resize['resize'],'title' => $item->name ])
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <div class="page-about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="col-md-10">
                        <div class="img-about">
                            @if($page)
                                @include('web.components.image', ['src' => $page->image_resize['lager'], 'title' => $page->title])
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-home-page">
                        @if($page)
                            <p class="hashtag-about"># Giới thiệu</p>
                            <h3 class="title-about">{{ $page->title }}</h3>
                            <div class="about-description">
                                {{ $page->description }}
                            </div>
                            <a href="{{ $page?route('page',$page->slug):'#' }}" class="btn btn-see-about">Tìm hiểu thêm <i class="fas fa-angle-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-order">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pe-5">
                    <p class="title-order">Thực đơn</p>
                    <div class="product-home">
                        <ul class="nav nav-tabs" id="myTabProduct" role="tablist">
                            @if(!empty($categories_product))
                                @forelse($categories_product as $k => $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $k === 0 ? 'active' : '' }}" id="{{ $category->slug }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $category->slug }}" type="button" role="tab" aria-controls="{{ $category->slug }}" aria-selected="{{ $k === 0 ? 'true' : 'false' }}">{{ $category->title }}</button>
                                    </li>
                                @empty
                                @endforelse
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContentProduct">
                            @if(!empty($categories_product))
                                @forelse($categories_product as $k => $category)
                                    <div class="tab-pane fade {{ $k === 0 ? 'show active' : '' }}" id="{{ $category->slug }}" role="tabpanel" aria-labelledby="{{ $category->slug }}-tab">
                                        @if(!empty($category->products))
                                            @forelse($category->products as $item)
                                                <div class="d-flex align-items-center justify-content-between item-product">
                                                    <a href="{{ route('productDetail',['slugCat'=>$item->category->slug,'slug'=>$item->slug]) }}" title="{{ $item->title }}">
                                                        @include('web.components.image', ['src' => $item->image_resize['small'], 'title' => $item->title])
                                                    </a>
                                                    <div class="info-title-product align-items-center justify-content-between">
                                                        <a href="{{ route('productDetail',['slugCat'=>$item->category->slug,'slug'=>$item->slug]) }}" title="{{ $item->title }}">
                                                            <p class="title-product-box">{{ $item->title }}</p>
                                                        </a>
                                                        <p class="price-product-box">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        @endif
                                        <a href="{{ route('productCat', $category->slug) }}" class="see-all-product">Xem tất cả <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                @empty
                                @endforelse
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-6 ps-5">
                    <p class="title-order">Đặt bàn trước</p>
                    <p class="des-order">Quý khách vui lòng đặt bàn trước 1 giờ để được phục vụ tốt nhất, mọi chi tiết liên hệ: <b>1900 0056 – 0909 911 112</b></p>
                    <form action="{{ route('order') }}" method="post">
                        <input type="text" class="form-control" placeholder="Họ và tên" name="full_name">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Số điện thoại" name="phone">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Địa chỉ Email" name="email">
                            </div>
                        </div>
                        <select name="" id="" class="form-control">
                            <option value="" selected disabled>Vui lòng chọn cơ sở</option>
                        </select>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date">
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="" id="">
                                            <option value="">Giờ đặt</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" min="1" placeholder="Số khách" name="number_customer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder="Ghi chú khi đặt bàn"></textarea>
                        <button class="btn btn-order-now" type="button" >Đặt bàn ngay <i class="fas fa-chevron-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="box-media">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 pe-3">
                    <div class="content-home-page">
                        <p class="hashtag-about"># Thư viện media</p>
                        <h3 class="title-about">tinh túy từ thiên nhiên</h3>
                        <div class="about-description">
                            <p>Hãy để sản phẩm của Lẩu Nấm Gia Khánh đem đến sức khỏe, niềm vui và sự nhiệt tình trong từng bữa ăn cho thực khách.
                                Chúng tôi cam kết luôn đồng hành cùng thực khách trong từng món ăn về giá trị dinh dưỡng, chất lượng và phong cách phục vụ. Với không gian kiến trúc mở, lấy thiên nhiên làm nền tảng, luôn thay đổi tạo cảm giác lạ và mới mẻ cho thực khách.</p>
                        </div>
                        <a href="{{ route('album') }}" class="btn btn-see-about">Xem tất cả <i class="fas fa-angle-right"></i></a>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="list-media">
                        <div class="row">
                            @forelse($videos as $item)
                                <div class="col-md-6">
                                    <div class="content-media-home for-image">
                                        <span>
                                            @include('web.components.image', ['src' => $item->image_resize['medium'], 'title' => $item->title])
                                        </span>
                                        <p class="title-media-item"><span>{{ $item->title }}</span></p>
                                        <span class="for-hover"></span>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            @forelse($images as $item)
                                <div class="col-md-6">
                                    <div class="content-media-home for-video">
                                        <div class="position-relative">
                                            <span>
                                                @include('web.components.image', ['src' => $item->image_resize['medium'], 'title' => $item->title])
                                            </span>
                                            <img src="{{ asset('images/Youtube.png') }}" alt="" class="play-youtube-video position-absolute top-50 start-50 translate-middle">
                                        </div>
                                        <p class="title-media-item"><span>{{ $item->title }}</span></p>
                                        <span class="for-hover"></span>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-new">
        <div class="container">
            <h3 class="text-center title-box-new">Tin tức mới nhất</h3>
            <div class="article-list-home">
                @forelse($articles as $item)
                    <div class="article-item">
                        <div class="article-item-content">
                            <a href="{{ route('detailArticle',['slug' => $item->slug,'id' => $item->id]) }}">
                                @include('web.components.image', ['src' => $item->image_resize['resize'], 'title' => $item->title])
                            </a>
                            <div class="box-content-article">
                                <p class="calendar-new"><i class="fas fa-calendar-alt"></i> {{ $item->created_at }}</p>
                                <a href="{{ route('detailArticle',['slug' => $item->slug,'id' => $item->id]) }}">
                                    <h4 class="title-article">{{ $item->title }}</h4>
                                </a>
                                <p class="description-article">{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/js/web/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/web/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/web/home.css') }}">
@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/web/slick/slick.js') }}"></script>
    <script>
        $('.slide-home').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            dot:false,
            fade: true,
            autoplay: true,
            autoplaySpeed: 2000,
            asNavFor: '.slider-nav-slide-home',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                }
            ]
        });
        $('.slider-nav-slide-home').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slide-home',
            dots: false,
            centerMode: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            focusOnSelect: true
        });

        $('.article-list-home').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                }
            ]
        });
    </script>
@endsection
