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

class MediaController extends Controller
{

    protected $mediaImageRepository,$mediaVideoRepository;

    public function __construct(MediaImageInterface $mediaImageRepository,MediaVideoInterface $mediaVideoRepository)
    {
        $this->mediaImageRepository = $mediaImageRepository;
        $this->mediaVideoRepository = $mediaVideoRepository;
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
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            $data['type'] = 1;
            $model = $this->mediaVideoRepository->create($data);
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
                $data['image'] = rawurldecode($data['image']);
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
                $data['image'] = rawurldecode($data['image']);
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
        $this->mediaImageRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_media_image_success')
        ];
    }
    public function destroyVideo($id)
    {
        $this->mediaVideoRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_media_video_success')
        ];
    }
}
