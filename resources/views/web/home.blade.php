@extends('web.layouts.web')

@section('content')
    <div class="top-content">
        <div class="slide-home">
            @forelse($slider as $item)
                @include('web.components.image', ['src' => $item->image, 'title' => $item->title])
            @empty
            @endforelse
        </div>
    </div>
    <div class="page-about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-10">
                        @if($page)
                            @include('web.components.image', ['src' => $page->image, 'title' => $page->title])
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    @if($page)
                        <p># Giới thiệu</p>
                        <h3>{{ $page->title }}</h3>
                        <div class="about-description">
                            {{ $page->description }}
                        </div>
                        <a href="" class="btn btn-danger">Tìm hiểu thêm</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="box-order">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pe-5">
                    Thực đơn
                    @if(!empty($categories_product))
                        @forelse($categories_product as $category)
                            <span>{{ $category->title }}</span>
                            @if(!empty($category->products))
                                @forelse($category->products as $item)
                                    <p>{{ $item->title }}</p>
                                @empty
                                @endforelse
                            @endif
                        @empty
                        @endforelse
                    @endif
                </div>
                <div class="col-md-6 ps-5">
                    Đặt bàn trước
                    <p>Quý khách vui lòng đặt bàn trước 1 giờ để được phục vụ tốt nhất, mọi chi tiết liên hệ: <b>1900 0056 – 0909 911 112</b></p>
                    <form action="">
                        <input type="text" class="form-control" placeholder="Họ và tên" name="full_name">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Số điện thoại" name="phone">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Địa chỉ Email" name="email">
                            </div>
                        </div>
                        <select name="" id="">
                            <option value="">Vui lòng chọn cơ sở</option>
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
                        <textarea name="" id="" cols="30" rows="5" class="form-control" placeholder="Ghi chú khi đặt bàn"></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="box-media">
        <div class="container">
            <div class="row">
                <div class="col-md-5 pe-3">
                    <p># Thư viện media</p>
                    <h3>tinh túy từ thiên nhiên</h3>
                    <div class="about-description">
                        <p>Hãy để sản phẩm của Lẩu Nấm Gia Khánh đem đến sức khỏe, niềm vui và sự nhiệt tình trong từng bữa ăn cho thực khách.
                            Chúng tôi cam kết luôn đồng hành cùng thực khách trong từng món ăn về giá trị dinh dưỡng, chất lượng và phong cách phục vụ. Với không gian kiến trúc mở, lấy thiên nhiên làm nền tảng, luôn thay đổi tạo cảm giác lạ và mới mẻ cho thực khách.</p>
                    </div>
                    <a href="" class="btn btn-danger">Xem tất cả</a>
                </div>
                <div class="col-md-7">
                    <div class="list-media">
                        <div class="row">
                            @forelse($videos as $item)
                                <div class="col-md-6">
                                    <div class="content-media-home">
                                        @include('web.components.image', ['src' => $item->image, 'title' => $item->title])
                                        <p>{{ $item->title }}</p>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            @forelse($images as $item)
                                <div class="col-md-6">
                                    <div class="content-media-home">
                                        @include('web.components.image', ['src' => $item->image, 'title' => $item->title])
                                        <p>{{ $item->title }}</p>
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
            <h3 class="text-center">Tin tức mới nhất</h3>
            <div class="article-list-home">
                @forelse($articles as $item)
                    <div class="article-item">
                        <a href="{{ route('detailArticle',['slug' => $item->slug,'id' => $item->id]) }}">
                            @include('web.components.image', ['src' => $item->image, 'title' => $item->title])
                        </a>
                        <p>{{ $item->created_at }}</p>
                        <a href="{{ route('detailArticle',['slug' => $item->slug,'id' => $item->id]) }}">
                            <h4>{{ $item->title }}</h4>
                        </a>
                        <p>{{ $item->description }}</p>
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
@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/web/slick/slick.js') }}"></script>
    <script>
        $('.slide-home').slick({
            infinite: true,
            slidesToShow: 1,
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
