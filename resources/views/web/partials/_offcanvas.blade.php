<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Đặt bàn</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Quý khách vui lòng đặt bàn trước 1 giờ để được phục vụ tốt nhất, mọi chi tiết liên hệ: 1900 0056 – 0909 911 112</p>
        <form action="" method="POST">
            <input type="text" name="full_name" class="form-control" placeholder="Họ và tên">
            <div class="row">
                <div class="col-md-6">
                    <input type="number" name="phone" class="form-control" placeholder="Số điện thoại">
                </div>
                <div class="col-md-6">
                    <input type="text" name="email" class="form-control" placeholder="Địa chỉ Email">
                </div>
            </div>
            <select name="" id="" class="form-control">
                <option value="" selected disabled>Vui lòng chọn cơ sở</option>
                <option value="">Cơ sở 1</option>
                <option value="">Cơ sở 2</option>
                <option value="">Cơ sở 3</option>
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
            <button class="btn btn-danger" type="button" >Đặt bàn ngay <i class="fas fa-chevron-right"></i></button>
        </form>
    </div>
</div>
