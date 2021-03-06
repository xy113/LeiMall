<?php

namespace App\Models;

/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $uid
 * @property int $order_id 订单ID
 * @property int $itemid 商品ID
 * @property string $title 商品名称
 * @property float $price 商品价格
 * @property float $promotion_price 优惠价
 * @property float $discount 折扣比例
 * @property string $thumb 缩略图
 * @property string $image 商品图片
 * @property int $quantity 商品数量
 * @property int $sku_id 属性ID
 * @property string $sku_name 商品属性
 * @property float $promotion_fee 优惠费用
 * @property float $shipping_fee 运费
 * @property float $total_fee 总费用
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePromotionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem wherePromotionPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereSkuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderItem whereUid($value)
 * @mixin \Eloquent
 */
class OrderItem extends BaseModel
{
    protected $table = 'order_item';
    protected $primaryKey = 'id';
}
