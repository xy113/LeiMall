<?php

namespace App\Http\Controllers\Post;

use App\Models\PostContent;
use App\Models\PostItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    /**
     *
     */
    public function index($aid=0){
        $this->assign(['aid'=>$aid]);

        PostItem::where('aid', $aid)->increment('view_num', 1);
        $article = PostItem::where('aid',$aid)->first();
        $this->assign(['article'=>$article]);

        $content = PostContent::where('aid', $aid)->first();
        $this->assign(['content'=>$content]);

        $this->assign(['hotnews'=>PostItem::where('status', 1)->orderBy('view_num', 'DESC')->limit(5)->get()]);

        return $this->view('post.'.$article['type']);
    }
}
