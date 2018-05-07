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
            $image = [
                'uid'=>$this->uid,
                'username'=>$this->username,
                'type'=>'image',
                'created_at'=>time(),
                'updated_at'=>time(),
                'extension'=>$file->extension(),
                'size'=>$file->getClientSize(),
                'name'=>$file->getClientOriginalName()
            ];

            $imagePath = $file->store('image/'.date('Y').'/'.date('m'));
            $img = Image::make(storage_public_path($imagePath));

            $image['source'] = $imagePath;
            $image['width']  = $img->width();
            $image['height'] = $img->height();
            $image['thumb']  = str_replace('image/', 'thumb/', $imagePath);

            @mkdir(dirname(storage_public_path($image['thumb'])), 0777, true);
            $img->resize(320, 480)->save(storage_public_path($image['thumb']));

            $image['id'] = Material::insertGetId($image);
            $image['image'] = $imagePath;
            $image['imageurl'] = image_url($imagePath);
            $image['thumburl'] = image_url($image['thumb']);

            unset($image['source']);
            return ajaxReturn(['image'=>$image]);
        }else {
            return ajaxError(1, 'upload image fail');
        }
    }
}
