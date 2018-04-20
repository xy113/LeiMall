<?php

namespace App\Models;

/**
 * App\Models\ItemImage
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string $thumb
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemImage whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemImage whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemImage whereUid($value)
 * @mixin \Eloquent
 */
class ItemImage extends BaseModel
{
    protected $table = 'item_image';
    protected $primaryKey = 'id';
}
