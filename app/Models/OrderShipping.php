<?php

namespace App\Models;

/**
 * App\Models\OrderShipping
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property int $order_id 订单ID
 * @property int $express_id 快递公司ID
 * @property string $express_name 快递名称
 * @property string $express_no 快递单号
 * @property int $shipping_type 物流类型，1=快递，2=无需物流
 * @property string $shipping_time 发货时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereShippingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereUid($value)
 * @mixin \Eloquent
 */
class OrderShipping extends BaseModel
{
    protected $table = 'order_shipping';
    protected $primaryKey = 'id';
}
