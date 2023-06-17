@extends('web.layouts.web')

@section('content')
    <div class="content-design">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <p>Bạn đang cần tìm 1 công ty</p>
                        <h2>Thiết kế ứng dụng
                        di động uy tín?</h2>
                    <p>FinalStyle - Đơn vị chuyên thiết kế app mobile, website và cung cấp các giải pháp cho doanh nghiệp 4.0 hiện nay.</p>
                    <p>Dưới thời đại công nghệ 4.0, các phần mềm, ứng dụng di động gần như có thể áp dụng được vào mọi lĩnh vực kinh doanh trong đời sống như mua bán, giao hàng, giáo dục, y tế…</p>
                </div>
                <div class="col-md-8">
                    <img src="{{ asset('images/design.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="content-design-app-tab">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <h2 class="text-center">Thiết kế App</h2>
                    <p>FinalStyle với sứ mệnh của 1 công ty thiết kế ứng dụng luôn mong muốn mang đến cho khách hàng của mình những dự án mobile app, website hay dịch vụ sử dụng phần mềm ứng dụng giá rẻ.</p>
                </div>
            </div>
            <div class="tab-categories">
                <ul class="nav nav-pills mb-3 justify-content-between" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">App bán hàng <i class="fas fa-angle-right"></i></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">App quản lý</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">App học trực tuyến</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">App đại lý</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="row align-items-center">
                            <div class="col-md-7"><img src="{{ asset('images/top4.png') }}" alt="" class="img-fluid"></div>
                            <div class="col-md-5">
                                <h3>Thiết kế app bán hàng</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                    <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-design-process">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>Chúng tôi sở hữu</p>
                        <h2>Quy trình thiết
                        kế app chuyên
                        nghiệp</h2>
                    <p>Quy trình thiết kế App theo yêu cầu chuyên nghiệp tại FinalStyle. Đảm bảo chất lượng khi đến tay khách hàng!</p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/about-me.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="content-design-project">
        <div class="container">
            <p class="text-center">Giải đáp các câu hỏi</p>
            <div class="text-center">khi sử dụng dịch vụ Finalstyle</div>
            <div class="slider-customer">
                    <img src="{{ asset('images/slider.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/design.css') }}">
@endsection

@section('script')
    @parent
    <!-- Bootstrap -->
    <script src="{{ asset('/js/web/bootstrap.bundle.min.js') }}"></script>
@endsection
