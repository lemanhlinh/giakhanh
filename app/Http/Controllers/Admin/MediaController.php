<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use App\DataTables\MediaImageDataTable;
use App\DataTables\MediaVideoDataTable;
use App\Http\Requests\Media\CreateMediaImage;
use App\Http\Requests\Media\UpdateMediaImage;
use App\Http\Requests\Media\CreateMediaVideo;
use App\Http\Requests\Media\UpdateMediaVideo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\MediaImageInterface;
use App\Repositories\Contracts\MediaVideoInterface;
use App\Models\MediaImage;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    protected $mediaImageRepository,$mediaVideoRepository;
    protected $resizeImage;

    public function __construct(MediaImageInterface $mediaImageRepository,MediaVideoInterface $mediaVideoRepository)
    {
        $this->mediaImageRepository = $mediaImageRepository;
        $this->mediaVideoRepository = $mediaVideoRepository;
        $this->resizeImage = $this->mediaImageRepository->resizeImage();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MediaImageDataTable $dataTable)
    {
        return $dataTable->render('admin.media-image.index');
    }

    public function indexVideo(MediaVideoDataTable $dataTable)
    {
        return $dataTable->render('admin.media-video.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media-image.create');
    }
    public function createVideo()
    {
        return view('admin.media-video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMediaImage $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $image_root = '';
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            $data['type'] = 0;
            $model = $this->mediaImageRepository->create($data);
            $sortedIds = explode(',', $data['sortedIds']);
            if (!empty($sortedIds)){
                foreach ($sortedIds as $item){
                    MediaImage::create([
                        'image' => $item,
                        'record_id' => $model->id,
                    ]);
                }
            }
            if (!empty($data['image'])){
                $this->mediaImageRepository->saveFileUpload($image_root,$this->resizeImage,$model->id,'media');
            }
            DB::commit();
            Session::flash('success', trans('message.create_media_image_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_media_image_error'));
            return redirect()->back();
        }
    }

    public function storeVideo(CreateMediaVideo $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $image_root = '';
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            $data['type'] = 1;
            $model = $this->mediaVideoRepository->create($data);
            if (!empty($data['image'])){
                $this->mediaVideoRepository->saveFileUpload($image_root,$this->resizeImage,$model->id,'media');
            }
            DB::commit();
            Session::flash('success', trans('message.create_media_video_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_media_video_error'));
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = $this->mediaImageRepository->getOneById($id,['mediaImages']);
        return view('admin.media-image.update', compact('image'));
    }

    public function editVideo($id)
    {
        $video = $this->mediaVideoRepository->getOneById($id);
        return view('admin.media-video.update', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateMediaImage $req)
    {
        $data_root = $this->mediaImageRepository->getOneById($id,['mediaImages']);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $media = $this->mediaImageRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $this->mediaImageRepository->removeImageResize($data_root->image,$this->resizeImage, $id,'media');
                $data['image'] = $this->mediaImageRepository->saveFileUpload($data['image'],$this->resizeImage, $id,'media');
            }
            $media->update($data);
            $sortedIds = explode(',', $data['sortedIds']);
            if (!empty($sortedIds)){
                MediaImage::where('record_id',$media->id)->delete();
                foreach ($sortedIds as $item){
                    MediaImage::create([
                        'image' => $item,
                        'record_id' => $media->id,
                    ]);
                }
            }
            DB::commit();
            Session::flash('success', trans('message.update_media_image_success'));
            return redirect()->route('admin.media-image.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_media_image_error'));
            return back();
        }
    }

    public function updateVideo($id, UpdateMediaVideo $req)
    {
        $data_root = $this->mediaVideoRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $page = $this->mediaVideoRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $this->mediaVideoRepository->removeImageResize($data_root->image,$this->resizeImage, $id,'media');
                $data['image'] = $this->mediaVideoRepository->saveFileUpload($data['image'],$this->resizeImage, $id,'media');
            }
            $page->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_media_video_success'));
            return redirect()->route('admin.media-video.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_media_video_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->mediaImageRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/media/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }

        $this->mediaImageRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_media_image_success')
        ];
    }
    public function destroyVideo($id)
    {

        $data = $this->mediaVideoRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/media/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }

        $this->mediaVideoRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_media_video_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $media_image = Media::findOrFail($id);
        $media_image->update(['active' => !$media_image->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_media_image_success')
        ];
    }
}
