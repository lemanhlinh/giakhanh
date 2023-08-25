<div class="order-now-right">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Đặt bàn trước</h5>
                    <button type="button" class="btn-close text-reset position-absolute top-50 start-0 translate-middle" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <p class="des-for-form">Quý khách vui lòng đặt bàn trước 1 giờ để được phục vụ tốt nhất, mọi chi tiết liên hệ: <b>1900 0056 – 0909 911 112</b></p>
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
            <div class="col-md-3"></div>
        </div>
    </div>

</div>
