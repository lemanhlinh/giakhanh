<div class="navbar-finalstyle">
    <div class="container-top">
        <div class="row align-items-center">
            <div class="col-md-3 col-2">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset($setting['logo']) }}" alt="{{ $setting['title'] }}" class="img-fluid logo-fs">
                </a>
            </div>
            <div class="col-md-9 d-none d-md-block">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="menu-top" id="main-menu">
                        <ul class="list-unstyled text-uppercase">
                            @if(!empty($menus))
                                @foreach ($menus as $shop)
                                    @include('web.components.menu.top', ['item'=>$shop])
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <form action="{{ route('language.switch') }}" class="form-select-lang" method="POST">
                        @csrf
                        <i class="fas fa-globe"></i>
                        <select name="locale" onchange="this.form.submit()">
                            <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Vi</option>
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>Eng</option>
                        </select>
                    </form>
                    <button class="btn btn-order" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Đặt bàn <i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="col-10 d-block d-md-none">
                <a href="#menu-mobile" class="d-block text-end text-white"><i class="fas fa-bars"></i></a>
            </div>
        </div>
    </div>
</div>

