@extends('web.layouts.web')

@section('content')
    <div class="content-detail">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>Liên hệ</p>
                    <h1>
                        Finalstyle rất hân
                        hạnh được hợp tác!</h1>
                    <span>Cảm ơn quí khách đã quan tâm đến dịch vụ thiết kế website của Final Style! <br> Nếu có bất cứ điều gì băn khoăn hoặc cần tư vấn, góp ý, đề xuất hợp tác xin vui lòng liên lạc với chúng tôi.</span>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/contact.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="content-detail-bottom py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    CÔNG TY TNHH PHONG CÁCH SỐ - FINALSTYLE
                    <ul>
                        <li>Hà Nội: Phòng 103, Tầng 1, Lô 2bx3, khu đô thị Mỹ Đình I - Hà Nội</li>
                        <li>TP HCM: 701 Lê Hồng Phong, P.10, Quận 10, TP HCM.</li>
                        <li>Điện thoại: (024) 6287 2977</li>
                    </ul>
                    <p>Mở rộng hợp tác và tư vấn kỹ thuật chuyên sâu: 0986 919925</p>
                    <p>Email: web@finalstyle.com</p>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('detailContactStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('web.contact.form')
                        <button type="submit" class="btn btn-primary">@lang('form.button.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
@endsection

@section('script')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let toastrSuccsee = '{{ Session::get('success') }}';
        let toastrDanger = '{{ Session::get('danger') }}';
        if (toastrDanger.length > 0 || toastrSuccsee.length > 0) {
            if (toastrDanger.length > 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: toastrDanger,
                })
                toastr["error"](toastrDanger)
            } else {
                Swal.fire(
                    'Thành công!',
                    toastrSuccsee,
                    'success'
                )
            }
        }
    </script>
@endsection
