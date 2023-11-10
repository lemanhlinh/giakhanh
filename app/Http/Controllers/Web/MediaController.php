<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Repositories\Contracts\MediaImageInterface;
use App\Repositories\Contracts\MediaVideoInterface;

class MediaController extends Controller
{
    protected $mediaImageRepository, $mediaVideoRepository;

    public function __construct(MediaImageInterface $mediaImageRepository, MediaVideoInterface $mediaVideoRepository)
    {
        $this->mediaImageRepository = $mediaImageRepository;
        $this->mediaVideoRepository = $mediaVideoRepository;
    }

    public function album(){
        $images = $this->mediaImageRepository->paginate(9,['id','title','image','created_at'],['active'=>1,'type'=>0],['mediaImages']);
//        $images = Media::with('mediaImages')->select('id','title','image')->get();


        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Hình ảnh Archives - Lẩu nấm gia khánh');
        SEOTools::setDescription('Với tiêu chí đó mỗi sản phẩm của Lẩu Nấm Gia Khánh đều được qua sàng lọc, chắt chiu, tinh khiết và quý báu nhất từ thiên nhiên. Nhằm mang đến cho thực khách những món ăn có giá trị về chất lượng và luôn lấy tiêu chí “ sức khỏe con người làm trung […]');
        SEOMeta::setKeywords('Lẩu nấm gia khánh, lẩu nấm');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');

        return view('web.media.album', compact('images'));
    }

    public function video(){
        $videos = $this->mediaVideoRepository->paginate(9,['id','title','image','link_video','created_at'],['active'=>1,'type'=>1]);
//        $videos = Media::select('id','title','image','link_video')->get();


        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Videos Archives - Lẩu nấm gia khánh');
        SEOTools::setDescription('Với tiêu chí đó mỗi sản phẩm của Lẩu Nấm Gia Khánh đều được qua sàng lọc, chắt chiu, tinh khiết và quý báu nhất từ thiên nhiên. Nhằm mang đến cho thực khách những món ăn có giá trị về chất lượng và luôn lấy tiêu chí “ sức khỏe con người làm trung […]');
        SEOMeta::setKeywords('Lẩu nấm gia khánh, lẩu nấm');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');

        return view('web.media.video', compact('videos'));
    }
}
