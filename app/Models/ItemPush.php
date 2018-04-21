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
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereUpdatedAt($value)
 */
class ItemPush extends BaseModel
{
    protected $table = 'item_push';
    protected $primaryKey = 'id';
}
