<?php

namespace App\Models;

/**
 * App\Models\OrderRefund
 *
 * @property int $refund_id
 * @property int $buyer_uid
 * @property int $seller_uid
 * @property int $shop_id
 * @property int $order_id
 * @property string $refund_no
 * @property int $refund_type
 * @property int $refund_status
 * @property string $refund_reason
 * @property string $refund_desc
 * @property float $refund_fee 退款费用
 * @property string $refund_time
 * @property int $seller_accepted 卖家已受理
 * @property int $seller_accept_type 卖家处理类型，1=接收，2=拒绝
 * @property string $seller_accept_time
 * @property string $seller_reply_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereBuyerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerAcceptTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerAcceptType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerReplyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereShopId($value)
 * @mixin \Eloquent
 */
class OrderRefund extends BaseModel
{
    protected $table = 'order_refund';
    protected $primaryKey = 'refund_id';
}
