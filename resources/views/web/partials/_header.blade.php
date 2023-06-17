<nav class="navbar-finalstyle">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Finalstyle - Phong cách số" class="img-fluid logo-fs"></a>
            </div>
            <div class="col-md-9">
                <div class="my-4" id="main-menu">
                    <ul class="d-flex justify-content-between list-unstyled text-uppercase">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('getContent') }}">Giới thiệu</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('getContentApp') }}" >
                                thiết kế app
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('homeArticle') }}" >tin công nghệ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('detailContact') }}" >Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
