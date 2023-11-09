<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function pageGioiThieu()
    {
        return redirect('/trang/gioi-thieu', 301); // 301 Redirect cho SEO
    }

    public function catTinTuc()
    {
        return redirect('/danh-muc-tin/tin-tuc', 301); // 301 Redirect cho SEO
    }

    public function catUuDai()
    {
        return redirect('/danh-muc-tin/uu-dai', 301); // 301 Redirect cho SEO
    }

    public function catProductCombo()
    {
        return redirect('/thuc-don/combo', 301); // 301 Redirect cho SEO
    }
    public function catProductKhaiVi()
    {
        return redirect('/thuc-don/khai-vi', 301); // 301 Redirect cho SEO
    }
    public function catProductThit()
    {
        return redirect('/thuc-don/thit', 301); // 301 Redirect cho SEO
    }
    public function catProductCanh()
    {
        return redirect('/thuc-don/canh', 301); // 301 Redirect cho SEO
    }
    public function catProductNam()
    {
        return redirect('/thuc-don/nam', 301); // 301 Redirect cho SEO
    }
    public function catProductNamThienNhien()
    {
        return redirect('/thuc-don/nam-thien-nhien', 301); // 301 Redirect cho SEO
    }
    public function catProductCacLoaiRau()
    {
        return redirect('/thuc-don/cac-loai-rau', 301); // 301 Redirect cho SEO
    }
    public function catProductLauTaiNha()
    {
        return redirect('/thuc-don/lau-tai-nha', 301); // 301 Redirect cho SEO
    }
    public function catProductMonTheoSet()
    {
        return redirect('/thuc-don/mon-theo-set', 301); // 301 Redirect cho SEO
    }
}
