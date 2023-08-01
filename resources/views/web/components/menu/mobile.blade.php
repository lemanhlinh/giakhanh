<li class="nav-item" >
    <a class="nav-link @if (request()->is('admin/role*')) active @endif" href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <span>Trang chủ</span>
    </a>
</li>
<li class="nav-item" >
    <a class="nav-link @if (request()->is('admin/role*')) active @endif" href="{{ route('homeCourse') }}">
        <i class="fas fa-book-open"></i>
        <span>Khóa học</span>
    </a>
</li>
<li class="nav-item" >
    <a class="nav-link @if (request()->is('admin/role*')) active @endif" href="{{ route('home') }}">
        <i class="fas fa-city"></i>
        <span>Trung tâm</span>
    </a>
</li>
<li class="nav-item" >
    <a class="nav-link @if (request()->is('admin/role*')) active @endif" href="{{ route('homeArticle') }}">
        <i class="far fa-newspaper"></i>
        <span>Tin tức</span>
    </a>
</li>
<li class="nav-item" >
    <a class="nav-link @if (request()->is('admin/role*')) active @endif" href="{{ route('detailContact') }}">
        <i class="fas fa-envelope"></i>
        <span>Liên hệ</span>
    </a>
</li>
