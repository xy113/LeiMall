<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopAuth;

class ShopController extends BaseController
{

    /**
     * 店铺列表
     * @throws \Exception
     */
    public function index(){

        if ($this->isOnSubmit()){
            $shops = $this->request->post('shops');
            $eventType = $this->request->post('eventType');
            if ($shops && is_array($shops)) {
                if ($eventType == 'delete'){
                    foreach ($shops as $shop_id) {
                        Shop::deleteData($shop_id);
                    }
                    return ajaxReturn(['return_code'=>0]);
                }

                if ($eventType == 'open'){
                    foreach ($shops as $shop_id) {
                        Shop::where('shop_id', $shop_id)->update(['closed'=>0]);
                    }
                    return ajaxReturn(['return_code'=>0]);
                }

                if ($eventType == 'close'){
                    foreach ($shops as $shop_id) {
                        Shop::where('shop_id', $shop_id)->update(['closed'=>1]);
                    }
                    return ajaxReturn(['return_code'=>0]);
                }
                return false;
            }else {
                return ajaxError(1, 'no select');
            }
        }else {
            $queryParams = [];
            $condition = [['auth_status', '=', 'SUCCESS']];
            $tab = $this->request->get('tab');
            !$tab && $tab = 'all';
            $this->assign(['tab'=>$tab]);
            $queryParams['tab'] = $tab;

            if ($tab == 'open'){
                $condition[] = ['closed', 0];
            }

            if ($tab == 'closed'){
                $condition[] = ['closed', 1];
            }

            $shop_name = $this->request->get('shop_name');
            $this->assign(['shop_name'=>$shop_name]);
            if ($shop_name) {
                $condition[] = ['shop_name', 'LIKE', "%$shop_name%"];
                $queryParams['shop_name'] = $shop_name;
            }

            $username = $this->request->get('username');
            $this->assign(['username'=>$username]);
            if ($username) {
                $condition[] = ['username', $username];
                $queryParams['username'] = $username;
            }

            $phone = $this->request->get('phone');
            $this->assign(['phone'=>$phone]);
            if ($phone) {
                $condition[] = ['phone', $phone];
                $queryParams['phone'] = $phone;
            }

            $shop_status = strtoupper($this->request->get('shop_status'));
            $this->assign(['shop_status'=>$shop_status]);
            if ($shop_status == 'OPEN'){
                $condition[] = ['closed', 0];
                $queryParams['shop_status'] = 'OPEN';
            }
            if ($shop_status == 'CLOSE'){
                $condition[] = ['closed', 1];
                $queryParams['shop_status'] = 'CLOSE';
            }

            $time_begin = $this->request->get('time_begin');
            $time_end = $this->request->get('time_end');
            $this->assign([
                'time_begin'=>$time_begin,
                'time_end'=>$time_end
            ]);

            if ($time_begin && !$time_end){
                $condition['created_at'] = array('>', strtotime($time_begin));
                $queryParams['time_begin'] = $time_begin;
            }elseif ($time_begin && $time_end){
                $condition[] = "`created_at`>".strtotime($time_begin)." AND `created_at`<".strtotime($time_end);
                $queryParams['time_begin'] = $time_begin;
                $queryParams['time_end'] = $time_end;
            }

            $shoplist = Shop::where($condition)->orderBy('shop_id')->paginate(20);
            $this->assign([
                'pagination'=>$shoplist->appends($queryParams)->links(),
                'shoplist'=>$shoplist
            ]);

            return $this->view('admin.shop.list');
        }
    }

    /**
     * 等待审核
     * @throws \Exception
     */
    public function pending(){

        if ($this->isOnSubmit()){
            $shops = $this->request->post('shops');
            $eventType = $this->request->post('eventType');
            if ($shops) {
                if ($eventType === 'delete'){
                    foreach ($shops as $shop_id){
                        Shop::deleteData($shop_id);
                    }
                }

                if ($eventType === 'accept'){
                    foreach ($shops as $shop_id){
                        Shop::where('shop_id', $shop_id)->update([
                            'closed'=>0,
                            'auth_status'=>'SUCCESS'
                        ]);
                    }
                }

                if ($eventType === 'refuse'){
                    foreach ($shops as $shop_id){
                        Shop::where('shop_id', $shop_id)->update([
                            'closed'=>1,
                            'auth_status'=>'FAIL'
                        ]);
                    }
                }
            }
            return ajaxReturn(['return_code'=>0]);
        }else {

            $q = $this->request->get('q');
            $shoplist = Shop::where('shop_name', 'LIKE', "%$q%")
                ->where(function ($query){
                    return $query->where('auth_status', 'FAIL')
                        ->orWhere('auth_status', 'PENDING');
                })->orderByDesc('shop_id')->paginate(20);
            $this->assign([
                'q'=>$q,
                'pagination'=>$shoplist->appends(['q'=>$q])->links(),
                'shoplist'=>$shoplist
            ]);
            return $this->view('admin.shop.pending');
        }
    }

    /**
     * 店铺详情
     */
    public function detail($shop_id){
        $this->assign([
            'shop_id'=>$shop_id,
            'shop'=>Shop::where('shop_id', $shop_id)->first(),
            'auth'=>ShopAuth::where('shop_id', $shop_id)->first()
        ]);

        return $this->view('admin.shop.detail');
    }

    /**
     * 认证店铺
     */
    public function auth(){
        $shop_id = $this->request->input('shop_id');
        $auth_status = strtoupper($this->request->input('auth_status'));
        $message = htmlspecialchars($this->request->input('message'));


        if ($auth_status == 'SUCCESS') {
            Shop::where('shop_id', $shop_id)->update(['auth_status'=>'SUCCESS', 'closed'=>'0']);
            ShopAuth::where('shop_id', $shop_id)->update(['status'=>'SUCCESS', 'updated_at'=>time()]);
        }else {
            Shop::where('shop_id', $shop_id)->update(['auth_status'=>'FAIL', 'closed'=>'1']);
            ShopAuth::where('shop_id', $shop_id)->update(['status'=>'FAIL', 'updated_at'=>time()]);
        }
        return $this->showSuccess(trans('mall.shop_auth_success'));
    }

    /**
     * 下载店铺数据
     */
    public function download(){
        $excelfile = CACHE_PATH.'shoplist.xls';
        $excel = new ExcelXML();
        file_put_contents($excelfile, $excel->getHeader());
        file_put_contents($excelfile, $excel->getRow(array(
            '店铺名称','卖家账号','联系电话','所在地','营业状态','开店日期'
        )), FILE_APPEND);

        $condition = array();
        $shop_name = htmlspecialchars($_GET['shop_name']);
        if ($shop_name) {
            $condition['shop_name'] = array('LIKE', $shop_name);
        }

        $username = htmlspecialchars($_GET['username']);
        if ($username) {
            $condition['username'] = $username;
        }

        $phone = htmlspecialchars($_GET['phone']);
        if ($phone) {
            $condition['phone'] = $phone;
        }

        $shop_status = strtoupper(htmlspecialchars($_GET['shop_status']));
        if ($shop_status == 'OPEN'){
            $condition['shop_status'] = 'OPEN';
        }
        if ($shop_status == 'CLOSE'){
            $condition['shop_status'] = 'CLOSE';
        }

        $time_begin = htmlspecialchars($_GET['time_begin']);
        $time_end = htmlspecialchars($_GET['time_end']);
        if ($time_begin && !$time_end){
            $condition['create_time'] = array('>', strtotime($time_begin));
        }elseif ($time_begin && $time_end){
            $condition[] = "`create_time`>".strtotime($time_begin)." AND `create_time`<".strtotime($time_end);
        }

        global $_lang;
        $rows = '';
        $shoplist = (new ShopModel())->where($condition)->order('shop_id')->select();
        foreach ($shoplist as $shop){
            $rows.= $excel->getRow(array(
                $shop['shop_name'], $shop['username'],$shop['phone'],
                $shop['province'].' '.$shop['city'].' '.$shop['county'],
                $_lang['shop_status'][$shop['closed']], date('Y-m-d', $shop['create_time'])
            ));
        }
        file_put_contents($excelfile, $rows, FILE_APPEND);
        file_put_contents($excelfile, $excel->getFooter(), FILE_APPEND);
        $this->showAjaxReturn();
    }

    /**
     * 下载文件
     */
    public function get_excel(){
        $excelfile = CACHE_PATH.'shoplist.xls';
        Download::downExcel($excelfile, null, true);
    }

    /**
     * 关闭店铺
     */
    public function close(){
        global $_G,$_lang;

        if ($this->checkFormSubmit()){
            $shops = $_GET['shops'];
            $closeReason = htmlspecialchars($_GET['closeReason']);
            $template_id = intval($_GET['template_id']);
            foreach (explode(',', $shops) as $shop_id){
                ShopModel::getInstance()->where(array('shop_id'=>$shop_id))->data(array('closed'=>1))->save();

            }
            $this->showAjaxReturn();
        }else {
            $notice_template_list = notice_get_template_list(array('template_type'=>'shop'));
            include template('shop/shop_close');
        }
    }
}
