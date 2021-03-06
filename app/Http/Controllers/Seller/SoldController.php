<?php

namespace App\Http\Controllers\Seller;

use App\Models\Order;
use App\Models\OrderItem;

class SoldController extends BaseController
{
    /**
     * 已卖出的宝贝
     */
    public function itemlist(){
        $tab = $this->request->get('tab');
        $tab = $tab ? $tab : 'all';
        $this->assign(['tab'=>$tab]);

        $condition = ['seller_uid'=>$this->uid];

        if ($tab == 'waitPay'){
            $condition['pay_status'] = 0;
        }elseif ($tab == 'waitSend'){
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 0;
        }elseif ($tab == 'send'){
            //$condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 0;
        }elseif ($tab == 'received') {
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 1;
        }elseif ($tab == 'reviewed'){
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 1;
            $condition['review_status'] = 1;
        }elseif ($tab == 'refunding'){
            $condition['is_closed'] = 0;
            $condition['refund_status'] = 1;
        }elseif ($tab == 'closed'){
            $condition['is_closed'] = 1;
        }

        $queryParams = array();
        $itemid = $this->request->get('itemid');
        $this->assign(['itemid'=>$itemid]);
        if ($itemid) {
            $condition['itemid'] = intval($itemid);
            $queryParams['itemid'] = $itemid;
        }

        $order_no = $this->request->get('order_no');
        $this->assign(['order_no'=>$order_no]);
        if ($order_no) {
            $condition['order_no'] = $order_no;
            $queryParams['order_no'] = $order_no;
        }

        $buyer_name = $this->request->get('buyer_name');
        $this->assign(['buyer_name'=>$buyer_name]);
        if ($buyer_name) {
            $condition['buyer_name'] = $buyer_name;
            $queryParams['buyer_name'] = $buyer_name;
        }

        $order_status = intval($this->request->get('order_status'));
        $this->assign(['order_status'=>$order_status]);
        if ($order_status) {
            switch ($order_status){
                case 1:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 0;
                    $condition['shipping_status'] = 0;
                    break;
                case 2:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['shipping_status'] = 0;
                    break;
                case 3:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['shipping_status'] = 1;
                    break;
                case 4:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['shipping_status'] = 1;
                    $condition['receive_status'] = 1;
                    break;
                case 6:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['refund_status'] = 1;
                    break;
                case 7:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['receive_status'] = 2;
                    break;
                default:;
            }
            $queryParams['order_status'] = $order_status;
        }

        $pay_type = intval($this->request->get('pay_type'));
        $this->assign(['pay_type'=>$pay_type]);
        if ($pay_type) {
            $condition['pay_type'] = $pay_type;
            $queryParams['pay_type'] = $pay_type;
        }

        $wuliu_status = intval($this->request->get('wuliu_status'));
        $this->assign(['wuliu_status'=>$wuliu_status]);
        if ($wuliu_status) {
            switch ($wuliu_status){
                case 1:
                    $condition['shipping_status'] = 0;
                    break;
                case 2:
                    $condition['shipping_status'] = 1;
                    break;
                case 3:
                    $condition['shipping_status'] = 1;
                    $condition['receive_status'] = 1;
                    break;
                default:;
            }
        }

        $title = $this->request->get('title');
        $this->assign(['title' => $title]);
        if ($title) {
            $condition['title'] = $title;
            $queryParams['title'] = $title;
        }

        $time_begin = htmlspecialchars($this->request->get('time_begin'));
        $time_end = htmlspecialchars($this->request->get('time_end'));
        $this->assign([
            'time_begin'=>$time_begin,
            'time_end'=>$time_end
        ]);
        if ($time_begin && !$time_end){
            $condition['create_at'] = array('>', strtotime($time_begin));
            $queryParams['time_begin'] = $time_begin;
        }elseif ($time_begin && $time_end){
            $condition[] = "`create_at`>".strtotime($time_begin)." AND `create_time`<".strtotime($time_end);
            $queryParams['time_begin'] = $time_begin;
            $queryParams['time_end'] = $time_end;
        }

        $orderList = $orderIds = [];
        $orders = Order::where($condition)->orderByDesc('order_id')->paginate(10);
        $this->assign(['pagination'=>$orders->appends($queryParams)->links()]);

        $orders->map(function ($order) use (&$orderList, &$orderIds){
            $orderIds[] = $order->order_id;
            $order->items = [];
            $orderList[$order->order_id] = $order->toArray();
        });

        if ($orderIds) {
            OrderItem::whereIn('order_id', $orderIds)->get()->map(function ($item) use (&$orderList){
                $orderList[$item->order_id]['items'][$item->itemid] = $item;
            });
        }

        $this->assign([
            'menu'=>'sold_items',
            'orderList'=>$orderList
        ]);
        return $this->view('seller.sold.itemlist');
    }

    /**
     * 下载订单记录
     */
    public function download(){
        $excelfile = CACHE_PATH.'shop_orders_'.$this->shop_id.'.xls';
        $offset = intval(cookie('export_offset'));

        $excel = new ExcelXML();
        if ($offset == 0){
            file_put_contents($excelfile, $excel->getHeader());
            file_put_contents($excelfile, $excel->getRow(array(
                '商品名称','订单编号','买家账号','订单金额','下单时间','付款方式','支付状态','发货状态'
            )), FILE_APPEND);
        }

        $condition = array('seller_uid'=>$this->uid);
        $itemid = htmlspecialchars($_GET['itemid']);
        if ($itemid) {
            $condition['itemid'] = intval($itemid);
            //$queryParams['itemid'] = $itemid;
        }

        $order_no = htmlspecialchars($_GET['order_no']);
        if ($order_no) {
            $condition['order_no'] = $order_no;
            //$queryParams['order_no'] = $order_no;
        }

        $buyer_name = htmlspecialchars($_GET['buyer_name']);
        if ($buyer_name) {
            $condition['buyer_name'] = array('LIKE', $buyer_name);
            //$queryParams['buyer_name'] = $buyer_name;
        }

        $order_status = intval($_GET['order_status']);
        if ($order_status) {
            switch ($order_status){
                case 1:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 0;
                    $condition['shipping_status'] = 0;
                    break;
                case 2:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['shipping_status'] = 0;
                    break;
                case 3:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['shipping_status'] = 1;
                    break;
                case 4:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['shipping_status'] = 1;
                    $condition['receive_status'] = 1;
                    break;
                case 6:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['refund_status'] = 1;
                    break;
                case 7:
                    $condition['pay_type'] = 1;
                    $condition['pay_status'] = 1;
                    $condition['receive_status'] = 2;
                    break;
                default:;
            }
            //$queryParams['order_status'] = $order_status;
        }

        $pay_type = intval($_GET['pay_type']);
        if ($pay_type) {
            $condition['pay_type'] = $pay_type;
            //$queryParams['pay_type'] = $pay_type;
        }

        $wuliu_status = intval($_GET['wuliu_status']);
        if ($wuliu_status) {
            switch ($wuliu_status){
                case 1:
                    $condition['shipping_status'] = 0;
                    break;
                case 2:
                    $condition['shipping_status'] = 1;
                    break;
                case 3:
                    $condition['shipping_status'] = 1;
                    $condition['receive_status'] = 1;
                    break;
                default:;
            }
        }

        $title = htmlspecialchars($_GET['title']);
        if ($title) {
            $condition['title'] = array('LIKE', $title);
            //$queryParams['title'] = $title;
        }

        $time_begin = htmlspecialchars($_GET['time_begin']);
        $time_end = htmlspecialchars($_GET['time_end']);
        if ($time_begin && !$time_end){
            $condition['create_time'] = array('>', strtotime($time_begin));
            //$queryParams['time_begin'] = $time_begin;
        }elseif ($time_begin && $time_end){
            $condition[] = "`create_time`>".strtotime($time_begin)." AND `create_time`<".strtotime($time_end);
            $queryParams['time_begin'] = $time_begin;
            //$queryParams['time_end'] = $time_end;
        }

        $order_list = (new OrderModel())->where($condition)->limit($offset, 100)->order('order_id DESC')->select();
        if ($order_list) {
            $uids = $order_ids = $datalist = array();
            foreach ($order_list as $order){
                $datalist[$order['order_id']] = $order;
                $order_ids[] = $order['order_id'];
                array_push($uids, $order['uid'], $order['seller_uid']);
            }
            $order_list = $datalist;

            $order_ids = $order_ids ? implodeids($order_ids) : 0;
            if ($order_ids) {
                $itemlist = (new OrderItemModel())->where(array('order_id'=>array('IN', $order_ids)))->group('order_id')->select();
                if ($itemlist) {
                    foreach ($itemlist as $item){
                        $order_list[$item['order_id']]['itemid'] = $item['itemid'];
                        $order_list[$item['order_id']]['title'] = $item['title'];
                        $order_list[$item['order_id']]['thumb'] = $item['thumb'];
                    }
                }
                unset($order_ids, $itemlist, $item);
            }

            $rows = '';
            foreach ($order_list as $order){
                $offset++;
                $rows.= $excel->getRow(array(
                    $order['title'],$order['order_no'],$order['buyer_name'],
                    formatAmount($order['total_fee']),date('Y-m-d H:i:s', $order['create_time']),
                    ($order['pay_type']==1 ? '在线支付' : '货到付款'), ($order['pay_status'] ? '已支付' : '未支付'),
                    ($order['shipping_status'] ? '已发货' : '未发货')
                ));
            }
            file_put_contents($excelfile, $rows, FILE_APPEND);
            cookie('export_offset', $offset);
            $this->showAjaxReturn();
        }else {
            cookie('export_offset', null);
            file_put_contents($excelfile, $excel->getFooter(), FILE_APPEND);
            $this->showAjaxError(1, 'complete');
        }
    }

    /**
     *
     */
    public function get_excel(){
        $excelfile = CACHE_PATH.'shop_orders_'.$this->shop_id.'.xls';
        Download::downExcel($excelfile, 'shop_orders_'.$this->shop_id.'.xls', true);
    }
}
