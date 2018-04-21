<?php

namespace App\Models;

/**
 * App\Models\ItemContent
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemContent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemContent extends BaseModel
{
    protected $table = 'item_content';
    protected $primaryKey = 'itemid';
}
