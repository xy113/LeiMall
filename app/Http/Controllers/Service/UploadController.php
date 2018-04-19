<?php

namespace App\Http\Controllers\Service;

use App\Models\Material;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    /**
     *
     */
    public function index(){

    }

    /**
     *
     */
    public function image(){
        if ($file = $this->request->file('file')) {
            $data = [
                'uid'=>$this->uid,
                'username'=>$this->username,
                'type'=>'image',
                'created_at'=>time(),
                'updated_at'=>time(),
                'extension'=>$file->extension(),
                'size'=>$file->getClientSize(),
                'name'=>$file->getClientOriginalName()
            ];

            $image = $file->store('image/'.date('Y').'/'.date('m'));
            $img = Image::make(storage_public_path($image));

            $data['width'] = $img->width();
            $data['height'] = $img->height();
            $data['thumb'] = str_replace('image/', 'thumb/', $image);
            $img->resize(320, 480)->save(storage_public_path($data['thumb']));

            $data['id'] = Material::insertGetId($data);
            $data['image'] = $image;
            $data['imageurl'] = image_url($image);
            $data['thumburl'] = image_url($data['thumb']);

            return ajaxReturn(['image'=>$data]);
        }else {
            return ajaxError(1, 'upload image fail');
        }
    }
}
