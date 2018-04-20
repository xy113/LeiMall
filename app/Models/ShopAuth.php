<?php

namespace App\Models;

/**
 * App\Models\ShopAuth
 *
 * @property int $id
 * @property int $uid 店主UID
 * @property int $shop_id 店铺ID
 * @property string $owner_id 店主身份证号
 * @property string $owner_name 店主姓名
 * @property string $id_card_pic_1 身份证正面照
 * @property string $id_card_pic_2 身份证背面照
 * @property string $id_card_pic_3 手持身份证照
 * @property string $license_no 营业执照号码
 * @property string $license_pic 营业执照照片
 * @property string $other_card_pic 其它证件照片
 * @property string $business_scope 经营范围
 * @property string $auth_status
 * @property string $auth_time
 * @property string $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereAuthStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereAuthTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereBusinessScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereIdCardPic1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereIdCardPic2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereIdCardPic3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereLicenseNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereLicensePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereOtherCardPic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopAuth whereUpdateTime($value)
 * @mixin \Eloquent
 */
class ShopAuth extends BaseModel
{
    protected $table = 'shop_auth';
    protected $primaryKey = 'id';
}
