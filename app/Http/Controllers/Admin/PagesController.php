<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;

class PagesController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){
        if ($this->isOnSubmit()){
            $delete = $this->request->post('delete');
            if ($delete) {
                foreach ($delete as $pageid){
                    Pages::where('pageid', $pageid)->delete();
                }
            }

            $pagelist = $this->request->input('pagelist');
            if ($pagelist) {
                foreach ($pagelist as $pageid=>$page){
                    Pages::where('pageid', $pageid)->update($page);
                }
            }
            return $this->showSuccess(trans('ui.save_succeed'));
        }else {
            $catid = $this->request->get('catid');
            $this->assign([
                'catid'=>$catid,
                'categorylist'=>[],
                'pagelist'=>[],
            ]);
            $condition[] = ['type', '=', 'page'];
            if ($catid) $condition[] = ['catid', '=', $catid];

            Pages::where('type', 'category')->get()->map(function ($c){
                $this->data['categorylist'][$c->pageid] = $c;
            });

            $pages = Pages::where($condition)->orderBy('displayorder', 'ASC')->orderBy('pageid', 'ASC')->paginate(20);
            $this->data['pagination'] = $catid ? $pages->appends(['catid'=>$catid])->links() : $pages->links();

            $pages->map(function ($page){
                $this->data['pagelist'][$page->pageid] = $page;
            });

            return $this->view('admin.pages.pages');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newpage(){
        if ($this->isOnSubmit()){
            $pageid = $this->request->input('pageid');
            $newpage = $this->request->post('newpage');
            if ($pageid) {
                $newpage['updated_at'] = time();
                Pages::where('pageid', $pageid)->update($newpage);
            }else {
                $newpage['type'] = 'page';
                $newpage['created_at'] = time();
                Pages::insert($newpage);
            }
            return $this->showSuccess(trans('ui.save_succeed'));
        }else {
            $pageid = $this->request->get('pageid');
            $this->assign([
                'catid'=>$this->request->get('catid'),
                'pageid'=>$pageid,
                'page'=>[
                    'title'=>'',
                    'alias'=>'',
                    'template'=>'',
                    'summary'=>'',
                    'content'=>''
                ],
                'categorylist'=>[]
            ]);

            if ($pageid) {
                $page = Pages::where('pageid', $pageid)->first();
                $this->assign([
                    'catid'=>$page->catid,
                    'page'=>$page
                ]);
            }

            Pages::where('type', 'category')->get()->map(function ($c){
                $this->data['categorylist'][$c->pageid] = $c;
            });

            return $this->view('admin.pages.newpage');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function category(){
        if ($this->isOnSubmit()){
            $delete = $this->request->post('delete');
            if ($delete) {
                foreach ($delete as $pageid){
                    Pages::where('catid', $pageid)->delete();
                    Pages::where('pageid', $pageid)->delete();
                }
            }

            $categorylist = $this->request->post('categorylist');
            if ($categorylist) {
                foreach ($categorylist as $pageid=>$category){
                    if ($category['title']) {
                        $category['updated_at'] = time();
                        if ($pageid > 0) {
                            Pages::where('pageid', $pageid)->update($category);
                        }else {
                            $category['type'] = 'category';
                            $category['created_at'] = time();
                            Pages::insert($category);
                        }
                    }
                }
            }
            return $this->showSuccess(trans('ui.save_succeed'));
        }else {

            $this->data['categorylist'] = [];
            Pages::where('type', 'category')->get()->map(function ($c){
                $this->data['categorylist'][$c->pageid] = $c;
            });

            return $this->view('admin.pages.category');
        }
    }
}
