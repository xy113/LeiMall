<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Pinyin;
use App\Models\Item;
use App\Models\ItemCatlog;
use Illuminate\Support\Facades\URL;

class ItemCatlogController extends BaseController
{
    /**
     *
     */
    public function index(){

        if ($this->isOnSubmit()) {
            $catloglist = $this->request->post('catloglist');
            if ($catloglist && is_array($catloglist)){
                foreach ($catloglist as $catid=>$catlog){
                    if ($catlog['name']) {
                        ItemCatlog::where('catid', $catid)->update($catlog);
                    }
                }
            }
            return $this->showSuccess(trans('ui.update_succeed'));
        }else {

            $catloglist = [];
            ItemCatlog::all()->map(function ($catlog) use (&$catloglist){
                $catloglist[$catlog->fid][$catlog->catid] = $catlog;
            });
            $this->assign([
                'catloglist'=>$catloglist
            ]);

            return $this->view('admin.item.catlog');
        }
    }

    /**
     * 编辑分类
     */
    public function edit(){

        $catid = $this->request->get('catid');
        if ($this->isOnSubmit()){
            $catlog = $this->request->post('catlog');
            if ($catlog['name']) {
                $pinyin = new Pinyin();
                $catlog['identifer'] = $pinyin->getPinyin($catlog['name']);
                if ($catid) {
                    ItemCatlog::where('catid', $catid)->update($catlog);
                }else {
                    ItemCatlog::insert($catlog);
                }

                return $this->showSuccess(trans('ui.update_succeed'), null, [
                    ['text'=>trans('common.reedit'), 'url'=>URL::current()],
                    array('text'=>trans('common.back_list'), 'url'=>\url('admin/itemcatlog'))
                ]);
            }else {
                return $this->showError(trans('ui.invalid_parameter'));
            }
        }else {

            $this->assign([
                'catid'=>$catid,
                'catlog'=>[
                    'fid'=>0,
                    'name'=>'',
                    'enable'=>1,
                    'available'=>1,
                    'template_index'=>'',
                    'template_list'=>'',
                    'template_detail'=>'',
                    'keywords'=>'',
                    'description'=>''
                ] ,
                'catloglist'=>$this->getCatlogList()
            ]);

            if ($catid) $this->assign(['catlog'=>ItemCatlog::where('catid', $catid)->first()]);

            return $this->view('admin.item.catlog_edit');
        }
    }

    /**
     * 删除分类
     */
    public function delete(){

        $catid = $this->request->get('catid');
        if ($this->isOnSubmit()){
            $moveto = intval($this->request->get('moveto'));
            $deleteChilds = intval($this->request->get('deleteChilds'));

            if (!$deleteChilds && !$moveto){
                return $this->showError(trans('ui.invalid_parameter'));
            }

            $childIds = $catlogModel->getAllChildIds($catid);
            if ($catlogModel->where(array('catid'=>$catid))->delete()){
                if ($deleteChilds) {
                    foreach ($childIds as $catid){
                        $catlogModel->where(array('catid'=>$catid))->delete();
                    }
                    $itemModel = new ItemModel();
                    $itemlist = $itemModel->where(array('catid'=>array('IN', implodeids($childIds))))->select();
                    foreach ($itemlist as $item){
                        $itemModel->deleteAllData($item['itemid']);
                    }
                }else {
                    foreach ($catlogModel->where(array('fid'=>$catid))->select() as $catlog){
                        $catlogModel->where(array('catid'=>$catlog['catid']))->data(array('fid'=>$moveto))->save();
                    }
                    $itemModel = new ItemModel();
                    $itemModel->where(array('catid'=>$catid))->data(array('catid'=>$moveto))->save();
                }
                $catlogModel->updateCache();
            }
            return $this->showSuccess(trans('ui.delete_succeed'), null, [
                array('text'=>'back_list', 'url'=>\url('admin/itemcatlogw'))
            ]);
        }else {

            $this->assign([
                'catid'=>$catid,
                'catlog'=>ItemCatlog::where('catid', $catid)->first(),
                'catloglist'=>$this->getCatlogList()
            ]);

            return $this->view('admin.item.catlog_delete');
        }
    }

    /**
     * 合并分类
     * @throws \Exception
     */
    public function merge(){

        if ($this->isOnSubmit()){
            $target = $this->request->post('target');
            $source = $this->request->post('source');
            if (is_array($source)) {
                foreach ($source as $catid){
                    if ($catid != $target){
                        Item::where('catid', $catid)->update(['catid'=>$target]);
                        ItemCatlog::where('catid', $catid)->delete();
                    }
                }
            }
            return $this->showSuccess(trans('ui.update_succeed'), null, [
                ['text'=>'back_list', 'url'=>\url('admin/itemcatlog')]
            ]);
        }else {


            $this->assign([
                'catloglist'=>$this->getCatlogList()
            ]);

            return $this->view('admin.item.catelog_merge');
        }
    }

    /**
     *
     */
    public function seticon(){
        $catid = $this->request->get('catid');
        $icon = $this->request->get('icon');
        if ($catid && $icon){
            ItemCatlog::where('catid', $catid)->update(['icon'=>$icon]);
        }
        return ajaxReturn(['return_code'=>0]);
    }

    private function getCatlogList(){
        $catloglist = [];
        ItemCatlog::all()->map(function ($catlog) use (&$catloglist){
            $catloglist[$catlog->fid][$catlog->catid] = $catlog;
        });
        return $catloglist;
    }
}
