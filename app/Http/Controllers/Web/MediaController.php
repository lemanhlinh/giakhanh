<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    public function album(){
        $images = Media::select('id','title','image')->get();
        if (!$images) {
            abort(404);
        }
        return view('web.media.album', compact('images'));
    }

    public function video(){
        $videos = Media::select('id','title','image','link_video')->get();
        if (!$videos) {
            abort(404);
        }
        return view('web.media.video', compact('videos'));
    }
}
