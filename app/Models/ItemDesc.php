<?php

namespace App\Models;

/**
 * App\Models\ItemDesc
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string $content
 * @property string $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereUpdateTime($value)
 * @mixin \Eloquent
 */
class ItemDesc extends BaseModel
{
    protected $table = 'item_desc';
    protected $primaryKey = 'id';
}
