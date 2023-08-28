<footer class="main-footer text-light">
    <div class="top-footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="{{ asset($setting['logo_footer']) }}" alt="{{ $setting['title'] }}" class="img-fluid logo-fs mb-4">
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
                                <span class="open-store">{!! $setting['time_work'] !!}</span>
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
                            <div class="fb-page" data-href="https://www.facebook.com/giakhanhhotpot" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/giakhanhhotpot" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/giakhanhhotpot">Lẩu Nấm Gia Khánh</a></blockquote></div>
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

<div class="hotline-all">
    <div class="hotline-icon">
        <a href="tel:19000056" class="text-hotline">1900 0056</a>
        <a href="tel:19000056" class="pulse">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                <path d="M20.97 17.33C20.97 17.69 20.89 18.06 20.72 18.42C20.55 18.78 20.33 19.12 20.04 19.44C19.55 19.98 19.01 20.37 18.4 20.62C17.8 20.87 17.15 21 16.45 21C15.43 21 14.34 20.76 13.19 20.27C12.04 19.78 10.89 19.12 9.75 18.29C8.58811 17.4401 7.49169 16.5041 6.47 15.49C5.45877 14.472 4.5261 13.3789 3.68 12.22C2.86 11.08 2.2 9.94 1.72 8.81C1.24 7.67 1 6.58 1 5.54C1 4.86 1.12 4.21 1.36 3.61C1.6 3 1.98 2.44 2.51 1.94C3.15 1.31 3.85 1 4.59 1C4.87 1 5.15 1.06 5.4 1.18C5.66 1.3 5.89 1.48 6.07 1.74L8.39 5.01C8.57 5.26 8.7 5.49 8.79 5.71C8.88 5.92 8.93 6.13 8.93 6.32C8.93 6.56 8.86 6.8 8.72 7.03C8.59 7.26 8.4 7.5 8.16 7.74L7.4 8.53C7.29 8.64 7.24 8.77 7.24 8.93C7.24 9.01 7.25 9.08 7.27 9.16C7.3 9.24 7.33 9.3 7.35 9.36C7.53 9.69 7.84 10.12 8.28 10.64C8.73 11.16 9.21 11.69 9.73 12.22C10.27 12.75 10.79 13.24 11.32 13.69C11.84 14.13 12.27 14.43 12.61 14.61C12.66 14.63 12.72 14.66 12.79 14.69C12.87 14.72 12.95 14.73 13.04 14.73C13.21 14.73 13.34 14.67 13.45 14.56L14.21 13.81C14.46 13.56 14.7 13.37 14.93 13.25C15.16 13.11 15.39 13.04 15.64 13.04C15.83 13.04 16.03 13.08 16.25 13.17C16.47 13.26 16.7 13.39 16.95 13.56L20.26 15.91C20.52 16.09 20.7 16.3 20.81 16.55C20.91 16.8 20.97 17.05 20.97 17.33Z" stroke="#fff" stroke-width="1.5" stroke-miterlimit="10"/>
            </svg>
        </a>
    </div>
</div>

