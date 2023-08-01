<nav class="navbar-finalstyle position-fixed w-100">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset($setting['logo']) }}" alt="{{ $setting['title'] }}" class="img-fluid logo-fs">
                </a>
            </div>
            <div class="col-md-9">
                <div class="my-4" id="main-menu">
                    <ul class="list-unstyled text-uppercase">
                        @if(!empty($menus))
                            @foreach ($menus as $shop)
                                @include('web.components.menu.top', ['item'=>$shop])
                            @endforeach
                        @endif
                    </ul>
                </div>
                <form action="{{ route('language.switch') }}" method="POST">
                    @csrf
                    <select name="locale" onchange="this.form.submit()">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                        <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Vietnamese</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</nav>
