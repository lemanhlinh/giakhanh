<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\CreateContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Liên hệ - Lẩu nấm gia khánh');
        SEOTools::setDescription('Với tiêu chí đó mỗi sản phẩm của Lẩu Nấm Gia Khánh đều được qua sàng lọc, chắt chiu, tinh khiết và quý báu nhất từ thiên nhiên. Nhằm mang đến cho thực khách những món ăn có giá trị về chất lượng và luôn lấy tiêu chí “ sức khỏe con người làm trung […]');
        SEOMeta::setKeywords('Lẩu nấm gia khánh, lẩu nấm');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');

        return view('web.contact.detail');
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContact $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            if ($data['contact_me_by_fax_only']){
                Session::flash('danger', trans('message.create_contact_error'));
                return redirect()->back();
            }
            Contact::create(
                [
                    'full_name' => $data['full_name'],
                    'content' => $data['content'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'title' =>  $data['title'],
                ]
            );
            DB::commit();
            Session::flash('success', trans('message.create_contact_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_contact_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }
}
