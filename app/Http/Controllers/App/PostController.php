<?php

namespace App\Http\Controllers\App;

use App\Models\PostComment;
use App\Models\PostContent;
use App\Models\PostImage;
use App\Models\PostItem;
use App\Models\PostMedia;

class PostController extends BaseController
{
    /**
     * @param $aid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function detail($aid){

        PostItem::where('aid', $aid)->increment('view_num');
        $article = PostItem::where(['aid'=>$aid, 'status'=>1])->first();
        if ($article) {
            $this->assign(['article'=>$article]);
        }else {
            return '<h3 style="text-align: center;">文章已被删除</h3>';
        }

        $content = PostContent::where('aid', $aid)->first();
        $content->content = cleanUpStyle($content->content);
        $content->content = preg_replace('/\<a(.*?)\>(.*?)\<\/a\>/is', '\\2', $content->content);
        $content->content = preg_replace('/\<img(.*?)src=\"(.*?)\"(.*?)>/is', '<img src="\\2">', $content->content);
        $this->assign(['content'=>$content]);

        if ($article->type == 'image'){
            $this->assign([
                'imageList'=>PostImage::where('aid', $aid)->get()
            ]);
        }

        if ($article['type'] == 'video') {
            $this->assign([
                'media'=>PostMedia::where('aid', $aid)->first()
            ]);
        }

        $hotCommentList = PostComment::where('aid', $aid)->limit(3)
            ->orderBy('likes', 'DESC')->get();
        $this->assign([
            'commentCount'=>$hotCommentList->count(),
            'hotCommentList'=>$hotCommentList
        ]);

        return $this->view('app.post.'.$article->type);
    }
}
