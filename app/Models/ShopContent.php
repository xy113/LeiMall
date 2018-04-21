<?php

namespace App\Models;

/**
 * App\Models\ShopContent
 *
 * @property int $uid 店主ID
 * @property int $shop_id 店铺ID
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopContent whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopContent whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopContent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopContent extends BaseModel
{
    protected $table = 'shop_content';
    protected $primaryKey = 'shop_id';
}
