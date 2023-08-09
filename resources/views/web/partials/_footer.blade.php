<footer class="main-footer text-light">
    <div class="top-footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="{{ asset($setting['logo_footer']) }}" alt="{{ $setting['title'] }}" class="img-fluid logo-fs">
                            <div class="list_infor_ft">
                                {!! $setting['footer_info'] !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="info-ft-phone">
                                <p>Hotline</p>
                                <span>{!! $setting['hotline'] !!}</span>
                            </div>
                            <div class="info-ft-phone">
                                <p>Giờ mở cửa</p>
                                <span>{!! $setting['time_work'] !!}</span>
                            </div>
                            <button class="btn btn-order" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Đặt bàn ngay <i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="text-center menu-bottom-ft">
                                <div class="title-menu-bt">Liên kết nhanh</div>
                                <ul class="list-unstyled list-item-menu-bt">
                                    <li><a href="">Liên hệ</a></li>
                                    <li><a href="">Thực đơn</a></li>
                                    <li><a href="">Khuyến mại</a></li>
                                    <li><a href="">Đặt bàn</a></li>
                                    <li><a href="">Câu hỏi thường gặp</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7448.063669809229!2d105.75938612222669!3d21.031412171926704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455f187c5bea7%3A0xb69e678ab877e937!2sC%C3%B4ng%20ty%20TNHH%20Phong%20C%C3%A1ch%20S%E1%BB%91%20-%20FinalStyle!5e0!3m2!1svi!2s!4v1677653625683!5m2!1svi!2s" width="100%" height="136" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <div class="link-to-restaurant">
                                <a href="{{ route('store') }}" class="btn btn-store"><i class="fas fa-map-marker-alt"></i> Hệ thống nhà hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
