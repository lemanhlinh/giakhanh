<nav class="navbar-finalstyle position-fixed w-100">
    <div class="container-top">
        <div class="row align-items-center">
            <div class="col-md-3">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset($setting['logo']) }}" alt="{{ $setting['title'] }}" class="img-fluid logo-fs">
                </a>
            </div>
            <div class="col-md-9">
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
        </div>
    </div>
</nav>
