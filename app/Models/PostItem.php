<?php

namespace App\Models;

class PostItem extends BaseModel
{
    protected $table = 'post_item';
    protected $primaryKey = 'aid';
    public $timestamps = false;

    /**
     * @param $aid
     * @throws \Exception
     */
    public static function deleteAll($aid){
        PostItem::where('aid', $aid)->delete();
        PostContent::where('aid', $aid)->delete();
        PostImage::where('aid', $aid)->delete();
        PostMedia::where('aid', $aid)->delete();
        PostLog::where('aid', $aid)->delete();
        PostComment::where('aid', $aid)->delete();
    }
}
