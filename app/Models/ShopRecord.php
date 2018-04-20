<?php

namespace App\Models;

/**
 * App\Models\ShopRecord
 *
 * @property int $id
 * @property int $shop_id 店铺ID
 * @property int $visit_num 访问量
 * @property int $order_num 订单量
 * @property float $turnovers 营业额
 * @property int $datestamp 日期
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopRecord whereDatestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopRecord whereOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopRecord whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopRecord whereTurnovers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopRecord whereVisitNum($value)
 * @mixin \Eloquent
 */
class ShopRecord extends BaseModel
{
    protected $table = 'shop_record';
    protected $primaryKey = 'id';
}
