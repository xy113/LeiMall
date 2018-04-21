<?php

namespace App\Models;

/**
 * App\Models\Shop
 *
 * @property int $shop_id 店铺ID
 * @property int $uid 店主UID
 * @property string $username 店主姓名
 * @property string $shop_name 店铺名称
 * @property string $shop_logo
 * @property string $shop_image
 * @property int $shop_type 店铺类型，1=个人店铺，2=企业店铺
 * @property string $phone 手机号码
 * @property string $province 所在省
 * @property string $city 所在市
 * @property string $county 所在县
 * @property string $street 街道
 * @property string $create_time 开店时间
 * @property string $update_time
 * @property int $view_num 浏览次数
 * @property int $collection_num 收藏数量
 * @property int $subscribe_num 关注量
 * @property float $lat 纬度
 * @property float $lng 经度
 * @property int $total_sold 累计销量
 * @property int $review_num_1 好评数量
 * @property int $review_num_2 中评数量
 * @property int $review_num_3 差评数量
 * @property string $intro 店铺简介
 * @property int $main_source 主要货源
 * @property int $closed 已关闭
 * @property string $auth_status 认证状态
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereAuthStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereCollectionNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereMainSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereReviewNum1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereReviewNum2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereReviewNum3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereShopType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereSubscribeNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereTotalSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUpdateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereViewNum($value)
 * @mixin \Eloquent
 * @property string $logo
 * @property int $type 店铺类型，1=个人店铺，2=企业店铺
 * @property string $district 所在县
 * @property int $created_at 开店时间
 * @property int $updated_at
 * @property int $views 浏览次数
 * @property int $collections 收藏数量
 * @property int $subscribes 关注量
 * @property string $description 店铺简介
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereSubscribes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop whereViews($value)
 */
class Shop extends BaseModel
{
    protected $table = 'shop';
    protected $primaryKey = 'shop_id';
}
