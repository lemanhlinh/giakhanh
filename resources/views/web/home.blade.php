@extends('web.layouts.web')

@section('content')
    <div class="top-content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h2>Chuyên thiết kế <br> ứng dụng mobile app</h2>
                    <p>Mục tiêu quan trọng nhất là phải cho ra những dự án thiết kế ứng dụng điện thoại đáp ứng được các tiêu chí của khách hàng về thiết kế app giá rẻ, phát triển tính năng, vấn đề bảo mật đảm bảo.</p>
                </div>
                <div class="col-md-8">
                    <img src="{{ asset('images/top.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="content-why">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <img src="{{ asset('images/top2.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <h2>Tại sao khách hàng<br>
                        chọn chúng tôi</h2>
                    <p>Mục tiêu quan trọng nhất là phải cho ra những dự án thiết kế ứng dụng điện thoại đáp ứng được các tiêu chí của khách hàng về thiết kế app giá rẻ, phát triển tính năng, vấn đề bảo mật đảm bảo.</p>
                    <button type="button" class="btn btn-primary">Tìm hiểu thêm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content-design-app">
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
    <div class="content-customer py-3">
        <div class="container">
            <h2 class="text-center">
                Dự án tiêu biểu của khách hàng
            </h2>
            <div class="slider-customer d-block text-center">
                <img src="{{ asset('images/top3.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="content-jobs-we">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <h2 class="text-center">những gì chúng tôi làm</h2>
                    <p>Khi bắt đầu triển khai 1 dự án thiết kế app hcm hay website thì chúng tôi sẽ giúp bạn nắm bắt những yếu tố sau</p>
                </div>
            </div>
            <div class="list-jobs">
                <div class="row">
                    <div class="col-md-4">
                        <div class="bg-white">
                            <h3>Tối ưu ngôn ngữ lập trình</h3>
                            <p>ứng dụng và website</p>
                            <span>Việc chọn công nghệ phù hợp để phát triển website và mobile app là một thách thức mà mọi doanh nghiệp thiết kế app hcm phải đối mặt, vì khi giai đoạn bắt đậu lựa chọn đúng sẽ cung cấp cho bạn một nền tảng vững chắc cho hoạt động và mở rộng sau này.
FinalStyle sử dụng Ruby on rails, Java, PHP, Swift,...là các ngôn ngữ lập hàng đầu để xây dựng nền tảng lập trình website và mobile app nhằm đáp ứng được các tiêu chí về tốc độ xử lý, tính bảo mật, khả năng mở rộng tính năng dễ dàng hơn. </span>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="bg-white">
                            <h3>Thiết kế app đa nền tảng</h3>
                            <p>IOS và Android</p>
                            <span>Để tối ưu được giao diện ứng dụng phù hợp, ngoài vấn đề về thẩm mỹ khách hàng, FinalStyle hướng đến việc tận dụng tư duy thiết kế tùy theo lĩnh vực nhằm đáp ứng được cả vấn đề về trải nghiệm sử dụng của người dùng.
Về vấn đề các công ty thiết kế ứng dụng hay gặp là tư vấn khách hàng nên chọn lập trình app trên nền tảng nào thì chúng tôi luôn muốn định hướng phát triển trên cả 2 nền tảng IOS và Android.
Việc triển khai dự án thiết kế app đa nền tảng nhằm giúp khách hàng tiếp cận được với gần như tất cả đối tượng người dùng Smartphone trên thế giới về độ lớn mạnh và ứng dụng của 2 hệ điều hành này.

Đồng thời tối ưu về chi phí khi bạn triển khai thiết kế ứng dụng điện thoại trên cả 2 nền tảng vì đó là sự hỗ trợ ưu đãi đến từ FinalStyle. </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white">
                            <h3>Nghiên cứu các xu hướng</h3>
                            <p>thiết kế app mobile mới nhất</p>
                            <span>Các thông tin dưới đây có thể sẽ định hướng các mảng nào sẽ là trend tiếp tục năm 2022.
Sự phát triển của 5G, với tốc độ nhanh gấp 100 lần so với 4g đã bắt đầu được triển khai trên mạng lưới người dùng smartphone toàn cầu. Ví điện tử, Momo, Zalopay, ShopeePay…đã thể hiện được tầm quan trọng trong cuộc sống của người tiêu dùng, chính vì các lợi ích mà nó mang lại trong thanh toán.
Việc giải trí và chơi game trên điện thoại đã trở thành 1 phần không thể thiếu trong cuộc sống của mỗi người. Tỷ lệ này tăng đều theo hàng năm và sẽ tiếp tục tăng.
Sự phát triển của công nghệ đã mang AR & VR, IOT ứng dụng vào trong đời sống, đem đến vô vàn tiện ích cho con người từ việc mua sắm, sử dụng đồ dùng thông minh và hoạt động trong công việc.
Tiếp nối những thành tựu của nền công nghiệp mobile app chúng ta cần phải nắm bắt các xu hướng thiết kế app hcm để mang đến các sản phẩm tốt nhất cho người dùng hiện tại và trong tương lai.
Đối tác phát triển</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-news pb-5">
        <div class="container">
            <h2 class="text-center">Tin công nghệ</h2>
            <div class="list-new">
                <div class="row">
                    @foreach($articles as $item)
                    <div class="col-md-4 position-relative">
                        <img src="{{ asset($item->image) }}" alt="" class="img-fluid">
                        <div class="title-new">
                            <p>Thứ bảy, 27/11/2021 06:00 (GMT+7)</p>
                            <h4>{{ $item->title }}</h4>
                        </div>
                        <a href="" class="stretched-link"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}">
@endsection

@section('script')
    @parent
    <!-- Bootstrap -->
    <script src="{{ asset('/js/web/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
@endsection
