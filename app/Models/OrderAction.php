<?php

namespace App\Models;

/**
 * App\Models\OrderAction
 *
 * @property int $action_id
 * @property int $uid 操作用户ID
 * @property string $username
 * @property int $order_id 订单ID
 * @property string $action_name 操作内容
 * @property string $action_time 操作时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereActionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereActionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereUsername($value)
 * @mixin \Eloquent
 */
class OrderAction extends BaseModel
{
    protected $table = 'order_action';
    protected $primaryKey = 'action_id';
}
