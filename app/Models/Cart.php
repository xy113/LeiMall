<?php

namespace App\Models;

/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int $uid
 * @property int $shop_id
 * @property string $shop_name
 * @property int $itemid
 * @property string $title
 * @property int $quantity
 * @property float $price 商品价格
 * @property string $thumb
 * @property string $image
 * @property int $sku_id
 * @property string $sku_name
 * @property string $create_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereSkuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUid($value)
 * @mixin \Eloquent
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUpdatedAt($value)
 */
class Cart extends BaseModel
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
}
