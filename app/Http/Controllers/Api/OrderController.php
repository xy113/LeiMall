<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderShipping;

class OrderController extends BaseController
{

    public function get(){

    }

    public function batchget(){

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_sold_items(){

        $offset = $this->request->input('offset');
        $count = $this->request->input('count');
        $offset = $offset ? $offset : 0;
        $count = $count ? $count : 20;

        $condition = ['seller_uid'=>$this->uid];
        $status = $this->request->input('status');
        if ($status == 'waitPay'){
            $condition['pay_status'] = 0;
        }elseif ($status == 'waitSend'){
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 0;
        }elseif ($status == 'send'){
            //$condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 0;
        }elseif ($status == 'received') {
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 1;
        }elseif ($status == 'reviewed'){
            $condition['pay_status'] = 1;
            $condition['shipping_status'] = 1;
            $condition['receive_status'] = 1;
            $condition['review_status'] = 1;
        }elseif ($status == 'refunding'){
            $condition['is_closed'] = 0;
            $condition['refund_status'] = 1;
        }elseif ($status == 'closed'){
            $condition['is_closed'] = 1;
        }

        $totalCount = Order::where($condition)->count();
        $orderList = [];
        Order::where($condition)->offset($offset)->limit($count)->orderByDesc('order_id')
            ->get()->map(function ($order) use (&$orderList){
                //echo $order->order_id;
                $order->quantity = 0;
                $order->avatar = avatar($order->buyer_uid);
                $order->key = "{$order->order_id}";
                $order->create_time = date('Y-m-d H:i:s', $order->create_time);
                $orderList[$order->order_id] = $order->toArray();
            });

        if ($orderList) {
            //订单关联商品
            OrderItem::whereIn('order_id', array_keys($orderList))->get()
                ->map(function ($item) use (&$orderList){
                    $item->thumb = image_url($item->thumb);
                    $item->image = image_url($item->image);
                    $orderList[$item->order_id]['quantity'] += $item->quantity;
                    $orderList[$item->order_id]['items'][] = $item;
                });
        }

        return ajaxReturn([
            'total_count'=>$totalCount,
            'offset'=>$offset,
            'count'=>$count,
            'items'=>array_values($orderList)
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_sold_order() {
        $order_id = $this->request->input('order_id');
        $order = Order::where(['order_id'=>$order_id, 'seller_uid'=>$this->uid])->first();
        if ($order) {
            $items = OrderItem::where('order_id', $order_id)->get();
            return ajaxReturn([
                'order'=>$order,
                'items'=>$items
            ]);
        }else {
            return ajaxError(1, 'not found');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(){
        $order_id = $this->request->input('order_id');
        if ($order = Order::where(['seller_uid'=>$this->uid, 'order_id'=>$order_id])->first()){
            $shipping_type = $this->request->input('shipping_type');

            if ($order->shipping_status) {
                return ajaxReturn(['order_id'=>$order_id]);
            }

            if ($order->pay_type === 1) {
                Order::where('order_id', $order_id)->update([
                    'shipping_type'=>$shipping_type,
                    'shipping_status'=>1,
                    'shipping_time'=>time()
                ]);
            }

            if ($order->pay_type == 2 && $order->shipping_status == 0) {
                Order::where('order_id', $order_id)->update([
                    'shipping_type'=>$shipping_type,
                    'shipping_status'=>1,
                    'shipping_time'=>time(),
                    'is_accepted'=>1
                ]);
            }

            if ($shipping_type == 1) {
                $express_id   = $this->request->input('express_id');
                $express_name = $this->request->input('express_name');
                $express_no   = $this->request->input('express_no');

                if ($express_id && $express_name && $express_no) {
                    OrderShipping::insert([
                        'uid'=>$this->uid,
                        'order_id'=>$order_id,
                        'express_id'=>$express_id,
                        'express_name'=>$express_name,
                        'express_no'=>$express_no,
                        'shipping_type'=>1,
                        'shipping_time'=>time()
                    ]);
                }else {
                    return ajaxError(1, 'invalid express parameter');
                }
            }else {
                OrderShipping::insert([
                    'uid'=>$this->uid,
                    'order_id'=>$order_id,
                    'shipping_type'=>2,
                    'shipping_time'=>time()
                ]);
            }
            return ajaxReturn(['order_id'=>$order_id]);
        }else {
            return ajaxError(2, 'order not exists');
        }
    }
}
