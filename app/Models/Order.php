<?php

namespace App\Models;

/**
 * App\Models\Order
 *
 * @property int $order_id
 * @property int $buyer_uid 买家ID
 * @property string $buyer_name 买家账号
 * @property int $seller_uid 卖家ID
 * @property string $seller_name 卖家账号
 * @property int $shop_id 店铺ID
 * @property string $shop_name 店铺名称
 * @property string $order_no 订单编号
 * @property float $order_fee 订单费用
 * @property float $shipping_fee 运费
 * @property float $total_fee 总费用
 * @property int $pay_type 付款方式，1=在线支付，2=货到付款
 * @property int $pay_status 支付状态，1=已支付，0=未支付
 * @property string $pay_time 付款时间
 * @property int $shipping_type 配送方式，1=快递，2=物流，3=无需物流
 * @property int $shipping_status 发货状态，0=未发货，1=已发货
 * @property string $shipping_time 发货时间
 * @property int $receive_status 收货状态，0=未收货，1=已收货
 * @property int $review_status 评价状态，0=未评价，1=已评价
 * @property int $refund_status 退款状态，0=无退款，1=退款中，2=退款完成
 * @property string $create_time 创建时间
 * @property string $deal_time 成交时间
 * @property string $trade_no 交易流水号
 * @property string $remark 买家留言
 * @property string $consignee 收货人
 * @property string $phone 联系电话
 * @property string $address
 * @property int $is_commited 已提交需求
 * @property int $is_accepted 已受理
 * @property int $is_closed 关闭订单
 * @property int $is_deleted 已删除
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereConsignee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDealTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsCommited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReceiveStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReviewStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTradeNo($value)
 * @mixin \Eloquent
 * @property int $pay_at 付款时间
 * @property int $shipping_at 发货时间
 * @property int $created_at 创建时间
 * @property int $updated_at
 * @property int $deal_at 成交时间
 * @property int $buyer_deleted 买家已删除
 * @property int $seller_deleted 卖家已删除
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDealAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 */
class Order extends BaseModel
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';

    /**
     * @param $order_id
     * @throws \Exception
     */
    public static function deleteOrder($order_id){
        $order = Order::where('order_id', $order_id)->get(['trade_no']);
        Order::where('order_id', $order_id)->delete();
        OrderItem::where('order_id', $order_id)->delete();
        OrderShipping::where('order_id', $order_id)->delete();
        OrderRefund::where('order_id', $order_id)->delete();
        OrderAction::where('order_id', $order_id)->delete();
        OrderClosed::where('order_id', $order_id)->delete();
        Trade::where('trade_no', $order->trade_no)->delete();
    }
    /**
     * @return int
     */
    public function getTradeStatus(){
        $trade_status = 0;
        if ($this->pay_type == 2){
            if ($this->is_commited == 1 && $this->is_accepted == 0){
                return 8;
            }else {
                return 9;
            }
        }
        if ($this->is_closed == 1 && $this->refund_status == 0) {
            //交易关闭
            return 0;
        }elseif ($this->refund_status == 1) {
            //退款中
            return 6;
        }elseif ($this->refund_status == 2) {
            //退款完成
            return 7;
        }else {
            if ($this->pay_status == 0 && $this->shipping_status == 0){
                //已下单未支付
                $trade_status = 1;
            }elseif ($this->pay_status == 1 && $this->shipping_status == 0){
                //已付款,未发货
                $trade_status = 2;
                /**
                 * @author panjone
                 * @date 2017-12-01
                 *
                 * 原逻辑为订单支付状态为pay_status=1,且发货状态为已放货shipping_status=1
                 * 修复逻辑错误
                 * 订单支付状态为pay_status=1
                 * 且发货状态为已放货shipping_status=1
                 * 且收货状态为receive_status=0
                 *
                 */
            }elseif ($this->pay_status == 1 && $this->shipping_status == 1 && $this->receive_status == 0){
                //已发货,待收货
                $trade_status = 3;
            }elseif ($this->pay_status == 1 && $this->shipping_status == 1
                && $this->receive_status == 1 && $this->review_status == 0){
                //已收货,未评价
                $trade_status = 4;
            }elseif ($this->pay_status == 1 && $this->shipping_status == 1
                && $this->receive_status == 1 && $this->receive_status == 1){
                //已收货,已评价
                $trade_status = 5;
            }
        }
        return $trade_status;
    }
}
