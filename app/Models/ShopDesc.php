<?php

namespace App\Models;

/**
 * App\Models\ShopDesc
 *
 * @property int $uid 店主ID
 * @property int $shop_id 店铺ID
 * @property string $content
 * @property string $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopDesc whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopDesc whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopDesc whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopDesc whereUpdateTime($value)
 * @mixin \Eloquent
 */
class ShopDesc extends BaseModel
{
    protected $table = 'shop_desc';
    protected $primaryKey = 'shop_id';
}
