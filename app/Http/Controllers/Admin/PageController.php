<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PagesTranslation;
use Illuminate\Http\Request;
use App\DataTables\PageDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\PageInterface;
use App\Http\Requests\Page\CreatePage;
use App\Http\Requests\Page\UpdatePage;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    protected $pageRepository;
    protected $resizeImage;

    public function __construct(PageInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->resizeImage = $this->pageRepository->resizeImage();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('admin.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $local = request()->query('local','vi');
        return view('admin.page.create', compact('local'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePage $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $image_root = '';
            $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            if (!empty($data['image_title'])){
                $image_title = $data['image_title'];
                $data['image_title'] = urldecode($image_title);
            }
            $model = $this->pageRepository->create($data);
            if (!empty($data['image'])){
                $this->pageRepository->saveFileUpload($image_root,$this->resizeImage,$model->id,'page');
            }
            $local = request()->input('locale','vi');
            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
                $langTranslation = new PagesTranslation([
                    'lang' => $localeCode,
                    'title' => $localeCode == $local ? $data['title']:'',
                    'image' => $localeCode == $local ? $data['image']:'',
                    'image_title' => $localeCode == $local ? $data['image_title']:'',
                    'slug' => $localeCode == $local ? $data['slug']:'',
                    'content' => $localeCode == $local ? $data['content']:'',
                    'description' => $localeCode == $local ? $data['description']:'',
                    'active' => $localeCode == $local ? $data['active']:0,
                    'is_home' => $localeCode == $local ? $data['is_home']:0,
                    'seo_title' => $localeCode == $local ? $data['seo_title']:'',
                    'seo_keyword' => $localeCode == $local ? $data['seo_keyword']:'',
                    'seo_description' => $localeCode == $local ? $data['seo_description']:''
                ]);
                $model->translations()->save($langTranslation);
            }
            DB::commit();
            Session::flash('success', trans('message.create_page_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_page_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $local = request()->query('local','vi');
        $page = $this->pageRepository->getOneById($id,['translations' => function($query) use ($local){
            $query->where(['lang'=> $local ]);
        }]);
        return view('admin.page.update', compact('page','local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdatePage $req)
    {
        $data_root = $this->pageRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $page = $this->pageRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $this->pageRepository->removeImageResize($data_root->image,$this->resizeImage, $id,'page');
                $data['image'] = $this->pageRepository->saveFileUpload($data['image'],$this->resizeImage, $id,'page');
            }
            if (!empty($data['image_title']) && $data_root->image_title != $data['image_title']){
                $data['image_title'] = rawurldecode($data['image_title']);
            }
            if (empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $page->update($data);
            $local = request()->input('locale','vi');
            $page->translations->where(['page_id'=> $id,'lang' => $local])->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_page_success'));
            return redirect()->back();
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_page_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->pageRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/page/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }
        $this->pageRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_page_success')
        ];
    }
}
