<?php

namespace App\Http\Controllers\Post;

use App\Models\ItemCatlog;
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

        PostItem::where('aid', $aid)->increment('views', 1);
        $article = PostItem::where('aid',$aid)->first();
        $this->assign(['article'=>$article]);

        $content = PostContent::where('aid', $aid)->first();
        $this->assign(['content'=>$content]);

        $catlog = ItemCatlog::where('catid', $article['catid'])->first();
        $this->assign(['catlog'=>$catlog]);

        $this->assign([
            'keywords'=>$article['tags'] ? implode(',', $article['tags']) : setting('keywords'),
            'description'=>$article['summary'] ? $article['summary'] : setting('description'),
            'newPostList'=>PostItem::where('status',1)->orderByDesc('aid')->limit(10)->get(),
            'hotPostList'=>PostItem::where('status',1)->orderByDesc('views')->limit(10)->get(),
        ]);

        return $this->view('post.'.$article['type']);
    }
}
