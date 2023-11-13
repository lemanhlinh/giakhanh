<div class="navbar-finalstyle">
    <div class="container-top">
        <div class="row align-items-center">
            <div class="col-4 col-lg-9 d-block d-lg-none">
                <a href="#menu-mobile" class="d-block text-start fzandcolor-iconmb"><i class="fas fa-bars"></i></a>
            </div>
            <div class="col-md-2 col-2 col-xl-3">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset($setting['logo']) }}" alt="{{ $setting['title'] }}" class="img-fluid logo-fs">
                </a>
            </div>
            <div class="col-md-9 col-5">
                <div class="d-flex align-items-center justify-content-md-between justify-content-end">
                    <div class="menu-top d-none d-lg-block" id="main-menu">
                        <ul class="list-unstyled text-uppercase">
                            @if(!empty($menus))
                                @foreach ($menus as $shop)
                                    @include('web.components.menu.top', ['item'=>$shop])
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="form-select-lang d-none d-lg-block">
                        <i class="fas fa-globe"></i>
                        <select name="locale" id="change_locale" class="text-capitalize">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <option value="https://launamgiakhanh.vn/{{ $localeCode }}" {{ LaravelLocalization::getCurrentLocale() == $localeCode ? 'selected' : '' }}>{{ $localeCode }}</option>
                                {{-- <option value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" {{ LaravelLocalization::getCurrentLocale() == $localeCode ? 'selected' : '' }}>{{ $localeCode }}</option>--}}
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-order" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Đặt bàn <i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>