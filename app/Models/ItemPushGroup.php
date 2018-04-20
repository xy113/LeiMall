<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemPushGroup
 *
 * @property int $groupid
 * @property string $grouptitle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPushGroup whereGroupid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPushGroup whereGrouptitle($value)
 * @mixin \Eloquent
 */
class ItemPushGroup extends Model
{
    protected $table = 'item_push_group';
    protected $primaryKey = 'groupid';
}
