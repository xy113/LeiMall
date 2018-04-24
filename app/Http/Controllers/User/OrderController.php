<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->assign(['menu'=>'order_manage']);
    }

    public function index(){
        $tab = $this->request->get('tab');
        $tab = $tab ? $tab : 'all';
        $this->assign(['tab'=>$tab]);

        $condition = [
            ['buyer_uid', '=', $this->uid],
            ['buyer_deleted', '=', 0]
        ];
        if ($tab == 'waitPay'){
            $condition['pay_status'] = 0;
        }elseif ($tab == 'waitSend'){
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 0;
        }elseif ($tab == 'waitConfirm'){
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 0;
        }elseif ($tab == 'waitRate'){
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 1;
            $condition['review_status'] = 0;
        }
        $q = $this->request->get('q');
        if ($q) $condition[] = ['order_no', '=', $q];

        $orderList = $orderids = [];
        $orders = Order::where($condition)->orderByDesc('order_id')->paginate(10);
        $this->assign(['pagination'=>$orders->links()]);
        $orders->map(function ($order) use (&$orderList, &$orderids){
            $orderids[] = $order->order_id;
            $order->items = [];
            $order->trade_status = 1;
            $orderList[$order->order_id] = $order->toArray();
        });

        if ($orderids) {
            OrderItem::whereIn('order_id', $orderids)->get()->map(function ($item) use (&$orderList){
                $orderList[$item->order_id]['items'][$item->itemid] = $item->toArray();
            });
        }

        $this->assign([
            'menu'=>'order_manage',
            'orderList'=>$orderList
        ]);

        return $this->view('user.order.list');
    }

    /**
     * 删除订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(){
        $order_id = intval($this->request->get('order_id'));
        $condition = ['buyer_uid'=>$this->uid, 'order_id'=>$order_id];
        if (Order::where($condition)->exists()) {
            Order::where($condition)->update(['buyer_deleted'=>1]);
            return ajaxReturn(['order_id'=>$order_id]);
        }else{
            return ajaxError(1, 'order delete fail');
        }
    }

    /**
     * 查看订单详情
     */
    public function detail(){

        $order_id = intval($this->request->get('order_id'));
        $condition = ['buyer_uid'=>$this->uid, 'order_id'=>$order_id];
        $order = Order::where($condition)->first();
        if (!$order) {
            return $this->showError('order_not_exists');
        }else {
            $itemlist = OrderItem::where('order_id', $order_id)->get();
            $this->assign([
                'order_id'=>$order_id,
                'order'=>$order,
                'itemlist'=>$itemlist
            ]);

            return $this->view('user.order.detail');
        }
    }

    /**
     * 确认收货
     */
    public function confirm(){
        $order_id = intval($this->request->get('order_id'));
        $condition = ['buyer_uid'=>$this->uid, 'order_id'=>$order_id];

        $order = Order::where($condition)->first();
        if ($order) {
            return ajaxReturn();
        }else {
            return ajaxError(1, 'confirm order fail');
        }
    }

    /**
     *
     */
    public function frame_close(){
        $order_id = intval($this->request->get('order_id'));
        $condition = ['buyer_uid'=>$this->uid, 'order_id'=>$order_id];

        $order_id = intval($_GET['order_id']);
        $orderModel = new OrderModel();
        $order = $orderModel->where(array('buyer_uid'=>$this->uid, 'order_id'=>$order_id))->getOne();
        if ($this->checkFormSubmit()){
            if ($order['pay_type'] == 1){
                if (order_get_trade_status($order) != 1){
                    $this->showAjaxError(1, 'order_can_not_close');
                }
            }else {
                if ($order['shipping_status']){
                    $this->showAjaxError(1, 'order_can_not_close');
                }
            }
            $close_reason = $_GET['otherReason'] ? htmlspecialchars($_GET['otherReason']) : htmlspecialchars($_GET['closeReason']);
            $orderModel->where(array('buyer_uid'=>$this->uid, 'order_id'=>$order_id))->data(array('is_closed'=>1))->save();
            (new OrderClosedModel())->data(array(
                'uid'=>$this->uid,
                'order_id'=>$order_id,
                'close_reason'=>$close_reason,
                'close_time'=>time()
            ))->add();
            $this->showAjaxReturn();
        }else {

            include template('frame_close_order');
        }
    }
}
