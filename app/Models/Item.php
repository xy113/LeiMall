<?php

namespace App\Models;

/**
 * App\Models\Item
 *
 * @property int $itemid 商品ID
 * @property int $uid 用户ID
 * @property int $catid 宝贝分类
 * @property int $shop_id 店铺ID
 * @property string $title 宝贝标题
 * @property string $subtitle 宝贝卖点
 * @property string $item_sn 商品编号
 * @property string $thumb 商品缩略图
 * @property string $image 商品图片
 * @property float $price 商品价格
 * @property float $market_price 市场价格
 * @property int $isdiscount 是否有折扣
 * @property int $on_sale 出售状态,1=出售中,0=已下架
 * @property int $is_best 仓储推荐
 * @property int $stock 库存
 * @property int $sold 累计销量
 * @property int $view_num 浏览量
 * @property int $collection_num 收藏数量
 * @property int $review_num 评论数
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 * @property float $shipping_fee 运费
 * @property string $unit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCollectionNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsBest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsdiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereItemSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereMarketPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereOnSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereReviewNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereViewNum($value)
 * @mixin \Eloquent
 */
class Item extends BaseModel
{
    protected $table = 'item';
    protected $primaryKey = 'itemid';

    /**
     * @param $itemid
     * @throws \Exception
     */
    public static function deleteItem($itemid) {
        $condition = ['itemid'=>$itemid];
        Item::where($condition)->delete();
        ItemImage::where($condition)->delete();
        ItemDesc::where($condition)->delete();
        ItemPush::where($condition)->delete();
        Collection::where(['datatype'=>'item', 'dataid'=>$itemid])->delete();
    }
}
