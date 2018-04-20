<?php

namespace App\Models;

/**
 * App\Models\OrderClosed
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property int $order_id 订单ID
 * @property string $close_reason 关闭原因
 * @property string $close_time 关闭时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereCloseReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereCloseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereUid($value)
 * @mixin \Eloquent
 */
class OrderClosed extends BaseModel
{
    protected $table = 'order_closed';
    protected $primaryKey = 'id';
}
