@extends('web.layouts.web')

@section('content')
    <div class="cart-content-products">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pe-md-5">
                    <h2 class="title-box-cart">Giỏ hàng</h2>
                    <ul class="list-unstyled list-product-in-cart">
                        @forelse($cartItems as $item)
                            <li>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset($item['product']->image) }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="title-product">{{ $item['product']->title }}</h4>
                                        <p>{{ format_money($item['product']->price) }}</p>
                                        <div class="number-input me-3">
                                            <button onclick="this.parentNode.querySelector('input.quantity-{{ $item["product"]->id }}').stepDown()"></button>
                                            <input type="number" min="1" name="quantity[{{ $item["product"]->id }}]" id="quantity-{{ $item["product"]->id }}" class="quantity quantity-{{ $item["product"]->id }}" value="{{ $item['quantity'] }}">
                                            <button onclick="this.parentNode.querySelector('input.quantity-{{ $item["product"]->id }}').stepUp()" class="plus"></button>
                                        </div>
                                        <p>{{ format_money($item['subtotal']) }}</p>
                                        <p class="remove-producty-in-cart">
                                            <a href="{{ route('removeItem',['id'=>$item["product"]->id]) }}" class="btn"><i class="fas fa-times"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>

                </div>
                <div class="col-md-6 ps-md-5">
                    <h2 class="title-box-cart">Thông tin khách hàng</h2>
                    <p class="description-for-form-cart">Bạn vui lòng nhập đúng số điện thoại để chúng tôi sẽ gọi xác nhận đơn hàng trước khi giao hàng. Xin cảm ơn!</p>
                    <form action="{{ route('order') }}" class="form-in-detail-cart" name="form-in-detail-cart" id="form-in-detail-cart" method="post">
                        @csrf
                        <div class="top-form">
                            <div class="form-group d-flex align-items-center">
                                <div class="custom-control custom-radio me-5 position-relative">
                                    <label for="gender1" class="custom-control-label">
                                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="0" id="gender1" name="gender" checked>
                                        <span class="checkmark"></span>
                                        Anh
                                    </label>
                                </div>
                                <div class="custom-control custom-radio position-relative">
                                    <label for="gender2" class="custom-control-label">
                                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="1" id="gender2" name="gender">
                                        <span class="checkmark"></span>
                                        Chị
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" value="{{ old('full_name') }}" class="form-control" name="full_name" placeholder="Họ và tên (bắt buộc)" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" value="{{ old('phone') }}" min="1" class="form-control" name="phone" placeholder="Số điện thoại (bắt buộc)" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" value="{{ old('email') }}" class="form-control" name="email" placeholder="Email (bắt buộc)" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" value="{{ old('address') }}" class="form-control" name="address" placeholder="Địa chỉ (không bắt buộc)">
                                </div>
                            </div>
                            <textarea name="note" id="note" cols="30" rows="1" class="form-control" placeholder="Ghi chú thêm (Ví dụ: Giao hàng trong giờ hành chính)">{{ old('note') }}</textarea>
                        </div>
                        <button class="form-control submit-form-popup" type="submit">Đặt hàng ngay <i class="fas fa-angle-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/product-cart.css') }}">
@endsection

@section('script')
    @parent
    <script>
        function removeItemCart(id_prd) {
            var quantity = $("#quantity").val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{{ route('addToCart') }}',
                data: {
                    quantity: quantity,
                    id: id_prd,
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success: function (data) {
                    console.log(data);
                    $("#number-added-cart").html(data.total);
                }
            });
        }
    </script>
@endsection
