<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\VideoParser;
use App\Models\PostCatlog;
use App\Models\PostContent;
use App\Models\PostImage;
use App\Models\PostItem;
use App\Models\PostLog;
use App\Models\PostMedia;
use Illuminate\Support\Facades\DB;

class PostController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){

        if ($this->isOnSubmit()) {
            $items = $this->request->input('items');
            $eventType = $this->request->input('eventType');
            if ($eventType === 'delete') {
                foreach ($items as $aid) {
                    PostItem::deleteAll($aid);
                }
            }

            if ($eventType === 'move') {
                $target = intval($this->request->input('target'));
                foreach ($items as $aid) {
                    PostItem::where('aid', $aid)->update(['catid'=>$target]);
                }
            }

            if ($eventType === 'resove') {
                foreach ($items as $aid) {
                    PostItem::where('aid', $aid)->update(['status'=>1]);
                }
            }

            if ($eventType === 'reject') {
                foreach ($items as $aid) {
                    PostItem::where('aid', $aid)->update(['status'=>-1]);
                }
            }
            return ajaxReturn();
        }else {
            $condition = $queryParams = [];
            $searchType = intval($this->request->input('searchType'));
            $queryParams['searchType'] = $searchType;
            $this->assign([
                'searchType'=>$searchType,
                'title'=>'',
                'username'=>'',
                'catid'=>0,
                'status'=>'',
                'type'=>'',
                'time_begin'=>'',
                'time_end'=>'',
                'q'=>'',
                'post_types'=>trans('post.post_types'),
                'post_status'=>trans('post.post_status'),
                'catloglist'=>PostCatlog::getTree(),
                'itemlist'=>[]
            ]);

            if ($searchType) {
                $title = $this->request->input('title');
                if ($title) {
                    $condition[] = ['i.title', 'LIKE', "%$title%"];
                    $queryParams['title'] = $title;
                    $this->data['title'] = $title;
                }

                $username = $this->request->input('username');
                if ($username) {
                    $condition[] = ['i.username', '=', $username];
                    $queryParams['username'] = $username;
                    $this->data['username'] = $username;
                }

                $catid = $this->request->input('catid');
                if ($catid) {
                    $condition[] = ['i.catid', '=', $catid];
                    $queryParams['catid'] = $catid;
                    $this->data['catid'] = $catid;
                }

                $status = $this->request->input('status');
                if ($status != '') {
                    $condition[] = ['i.status', '=', $status];
                    $queryParams['status'] = $status;
                    $this->data['status'] = $status;
                }

                $type = $this->request->input('type');
                if ($type) {
                    $condition[] = ['i.type', '=', $type];
                    $queryParams['type'] = $type;
                    $this->data['type'] = $type;
                }

                $time_begin = $this->request->input('time_begin');
                if ($time_begin) {
                    $condition[] = ['i.create_at', '>', strtotime($time_begin)];
                    $queryParams['time_begin'] = $time_begin;
                    $this->data['time_begin'] = $time_begin;
                }

                $time_end = $this->request->input('time_end');
                if ($time_end) {
                    $condition[] = ['i.create_at', '<', strtotime($time_end)];
                    $queryParams['time_end'] = $time_end;
                    $this->data['time_end'] = $time_end;
                }

            }else {
                $q = $this->request->input('q');
                if ($q) {
                    $condition[] = ['i.title', 'LIKE', "%$q%"];
                    $queryParams['q'] = $q;
                    $this->data['q'] = $q;
                }
            }

            $items = DB::table('post_item as i')
                ->leftJoin('post_catlog as c', 'c.catid', '=', 'i.catid')
                ->where($condition)
                ->select('i.*', 'c.name as cat_name')
                ->orderBy('i.aid','DESC')
                ->paginate(20);
            $this->data['pagination'] = $items->appends($queryParams)->links();
            $items->map(function ($item){
                $this->data['itemlist'][$item->aid] = get_object_vars($item);
            });

            return $this->view('admin.post.list');
        }
    }

    /**
     * 移动文章
     */
    public function move(){
        $items = $this->request->post('items');
        $target = $this->request->post('target');
        if ($items) {
            foreach ($items as $aid) {
                PostItem::where('aid', $aid)->update(['catid'=>$target]);
            }
        }

        return ajaxReturn();
    }

    /**
     * 设置文章图片
     */
    public function setimage(){
        $aid = $this->request->input('aid');
        $image = $this->request->input('image');
        if ($aid && $image){
            PostItem::where('aid', $aid)->update(['image'=>$image]);
            return ajaxReturn();
        }else {
            return ajaxError(1, 'invalid parameter');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function newpost(){

        $aid   = $this->request->get('aid');
        $catid = $this->request->get('catid');
        $type  = $this->request->input('type');
        $type  = in_array($type, array('image','video', 'voice')) ? $type : 'article';
        $this->assign([
            'aid'=>$aid,
            'catid'=>$catid,
            'type'=>$type,
            'item'=>[
                'aid'=>0,
                'type'=>$type,
                'catid'=>0,
                'created_at'=>date('Y-m-d H:i:s'),
                'title'=>'',
                'from'=>setting('sitename'),
                'fromurl'=>setting('siteurl'),
                'image'=>'',
                'alias'=>'',
                'allowcomment'=>'',
                'tags'=>'',
                'author'=>$this->username,
                'price'=>0,
                'summary'=>''
            ],
            'content'=>[
                'aid'=>0,
                'content'=>'',
                'created_at'=>time(),
                'updated_at'=>time()
            ],
            'gallery'=>[],
            'media'=>[]
        ]);

        if ($aid) {
            $item = PostItem::where('aid', $aid)->first();
            if ($item) {
                $item->created_at = $item->created_at ? @date('Y-m-d H:i:s', $item->created_at) : @date('Y-m-d H:i:s');
                $item->type = in_array($item->type, ['image','video']) ? $item->type : 'article';
                $this->assign([
                    'type'=>$item->type,
                    'catid'=>$item->catid,
                    'item'=>$item
                ]);
            }

            $this->data['content'] = PostContent::where('aid',$aid)->first();

            //相册列表
            $this->data['gallery'] = PostImage::where('aid', $aid)->orderBy('displayorder')->orderBy('id')->get();

            //获取媒体信息
            $this->data['media'] = PostMedia::where('aid', $aid)->first();

        }
        $this->data['catloglist'] = PostCatlog::getTree();
        return $this->view('admin.post.newpost');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function save(){
        $aid = $this->request->input('aid');
        $newpost = $this->request->post('newpost');
        $content = $this->request->post('content');

        if (is_array ($newpost)) {

            if (!$newpost['title']) {
                return $this->showError(trans('post.post title empty'));
            }

            if (!$newpost['from']) {
                $newpost['from'] = setting('sitename');
            }

            if (!$newpost['fromurl']) {
                $newpost['fromurl'] = setting('fromurl');
            }

            $summary = $newpost['summary'];
            if (!$summary) {
                $summary = mb_substr(stripHtml($content), 120);
            }
            $summary = str_replace('&amp;', '&', $summary);
            $summary = str_replace('&nbsp;', '', $summary);
            $summary = str_replace('　', '', $summary);
            $summary = preg_replace('/\s/', '', $summary);
            $newpost['summary'] = $summary;

            //发布时间设置
            $newpost['created_at'] = $newpost['created_at'] ? strtotime($newpost['created_at']) : time();

            $eventType = $aid ? 'update' : 'insert';
            if ($eventType == 'update') {
                //修改文章
                $newpost['updated_at'] = time();
                PostItem::where('aid',$aid)->update($newpost);
                //记录日志
                PostLog::insert([
                    'aid'=>$aid,
                    'title'=>$newpost['title'],
                    'uid'=>$this->uid,
                    'username'=>$this->username,
                    'action_type'=>'update',
                    'created_at'=>time(),
                    'updated_at'=>time()
                ]);
            }else {
                //添加新文章
                $newpost['uid'] = $this->uid;
                $newpost['username'] = $this->username;
                $aid = PostItem::insertGetId($newpost);

                //记录日志
                PostLog::insert([
                    'aid'=>$aid,
                    'title'=>$newpost['title'],
                    'uid'=>$this->uid,
                    'username'=>$this->username,
                    'action_type'=>'insert',
                    'created_at'=>time(),
                    'updated_at'=>time()
                ]);
            }

            //保存文章内容
            if (PostContent::where('aid', $aid)->exists()){
                PostContent::where('aid', $aid)->update([
                    'content'=>$content,
                    'updated_at'=>time()
                ]);
            }else {
                PostContent::insert([
                    'aid'=>$aid,
                    'content'=>$content,
                    'created_at'=>time()
                ]);
            }

            //添加相册
            $gallery = $this->request->post('gallery');
            if (is_array($gallery)) {
                $imageList = [];
                if ($eventType == 'update') {
                    foreach (PostImage::where('aid',$aid)->orderBy('displayorder')->get() as $img){
                        $imageList[$img['id']]['mark'] = 'delete';
                        $imageList[$img['id']]['img'] = $img;
                    }
                }

                $displayorder = 0;
                foreach ($gallery as $id=>$img){
                    $imageList[$id]['img'] = $img;
                    $imageList[$id]['img']['displayorder'] = $displayorder++;
                    if (isset($imageList[$id])) {
                        $imageList[$id]['mark'] = 'update';
                    }else {
                        $imageList[$id]['mark'] = 'insert';
                    }
                }

                foreach ($imageList as $id=>$img){
                    if ($img['mark'] == 'insert'){
                        $img['img']['aid'] = $aid;
                        $img['img']['uid'] = $this->uid;
                        PostImage::insert($img['img']);
                    }elseif ($img['mark'] == 'update'){
                        PostImage::where('id',$id)->update($img['img']);
                    }else {
                        PostImage::where(array('id'=>$id))->delete();
                    }
                }
                //将第一张设为文章图片
                if (!$newpost['image']) {
                    $image = reset($gallery);
                    PostItem::where('aid',$aid)->update(['image'=>$image['image']]);
                }
            }

            $media = $this->request->post('media');
            if ($media && $media['original_url']){
                if ($source = VideoParser::parse($media['original_url'])) {
                    $media['aid'] = $aid;
                    $media['media_source'] = $source->swf;
                    $media['media_thumb'] = $source->img;
                    $media['media_link'] = $source->url;

                    if (PostMedia::where('aid', $aid)->exists()){
                        PostMedia::where('aid', $aid)->update($media);
                    }else {
                        PostMedia::insert($media);
                    }
                }
            }

            if ($eventType == 'update'){
                return $this->showSuccess(trans('post.post update success'), null, [
                    [
                        'text' => trans('common.reedit'),
                        'url' => url('/admin/post/newpost?aid='.$aid)
                    ],
                    [
                        'text'=>trans('common.view'),
                        'url'=>post_url($aid),
                        'target'=>'_blank'
                    ],
                    [
                        'text'=>trans('common.back_list'),
                        'url'=>url('/admin/post')
                    ]
                ], null,false);
            }else {
                return $this->showSuccess(trans('post.post save success'), null, [
                    [
                        'text' => trans('common.continue_publish'),
                        'url' => url('/admin/post/newpost?type='.$newpost['type'].'&catid='.$newpost['catid'])
                    ],
                    [
                        'text'=>trans('common.view'),
                        'url'=>post_url($aid),
                        'target'=>'_blank'
                    ],
                    [
                        'text'=>trans('common.back_list'),
                        'url'=>url('/admin/post')
                    ]
                ], null,true);
            }

        } else {
            return $this->showError(trans('common.invalid parameter'));
        }
    }
}
