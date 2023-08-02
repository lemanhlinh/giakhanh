@extends('web.layouts.web')

@section('content')
    <div class="content-detail">
        <div class="container text-center">
            <h1>{{ $setting['site_name'] }}</h1>
            <div class="row">
                <div class="col-md-3">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Trụ sở chính</p>
                    <p>{{ $setting['main_local'] }}</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-phone-alt"></i>
                    <p>Điện thoại</p>
                    <p>{{ $setting['hotline'] }}</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-envelope"></i>
                    <p>Email</p>
                    <p>{{ $setting['email'] }}</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-globe"></i>
                    <p>Website</p>
                    <p>{{ $setting['website'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detail-bottom py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {!! $setting['map_contact'] !!}
                </div>
                <div class="col-md-6">
                    {!! $setting['info_contact'] !!}
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
