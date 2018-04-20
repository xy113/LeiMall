<?php

namespace App\Models;

/**
 * App\Models\ItemPush
 *
 * @property int $push_id
 * @property int $uid
 * @property int $itemid 商品ID
 * @property int $groupid
 * @property string $create_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereGroupid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush wherePushId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereUid($value)
 * @mixin \Eloquent
 */
class ItemPush extends BaseModel
{
    protected $table = 'item_push';
    protected $primaryKey = 'push_id';
}
