@extends('web.layouts.web')

@section('content')
    <div class="bg-out-content-about">
        <div class="top-content-about" style="background-image: url({{ asset('images/banner-about.png') }}); ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <p>Who we are</p>
                        <h2>
                            Chúng tôi là ai?</h2>
                        <p><span>"Qua hơn 16 năm kinh nghiệm thiết kế web, phần mềm do FinalStyle xây dựng được khẳng định thông qua các sản phẩm cho các Doanh nghiệp hàng đầu Việt Nam."</span></p>
                        <p><span>Chúng tôi sẽ tư vấn cho bạn những gì TỐT NHẤT.
    Mọi thắc mắc của bạn sẽ được chúng tôi giải đáp.</span></p>
                    </div>
                    <div class="col-md-8">
                        <div class="d-md-none"><img src="{{ asset('images/banner-about.png') }}" alt="" class="img-fluid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-choose-me">
        <div class="container">
            <p class="text-center">Tại sao khách hàng</p>
            <div class="text-center">tin tưởng chọn chúng tôi</div>
            <div class="row">
                <div class="col-md-6">
                    content
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/about-me.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="content-about-customer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <p>Là đối tác của</p>
                        <h2>những thương
                        hiệu lớn</h2>
                    <p>Qua 16 năm kinh nghiệm, FinalStyle đã xây dựng hệ thống cho hơn 3000
                        khách hàng trong và ngoài nước, là đối tác của nhiều thương hiệu Uy tín
                        tại Việt Nam</p>
                </div>
                <div class="col-md-8">
                    <img src="{{ asset('images/customer.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="content-about-faq">
        <div class="container">
            <p class="text-center">Giải đáp các câu hỏi</p>
                <div class="text-center">khi sử dụng dịch vụ Finalstyle</div>
            <div class="row">
                <div class="col-md-6">
                    <ol>
                        <li>Tôi nên làm app chạy trên hệ điều hành nào? iOS hay Android?</li>
                        <li>Tốn bao nhiêu tiền để có 1 app mobile?</li>
                        <li>Một startup như công ty tôi có cần làm app mobile không?</li>
                        <li>Dịch vụ Ecommerce Enabler của FinalStyle là gì?</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/iPhone-about.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/about.css') }}">
@endsection

@section('script')
    @parent
@endsection
