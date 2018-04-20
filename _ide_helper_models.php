<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Material
 *
 * @property int $id
 * @property int $uid
 * @property string $username
 * @property int $albumid 专辑ID，图片素材有效
 * @property string $name
 * @property string $path
 * @property string $thumb
 * @property string $width
 * @property string $height
 * @property string $type
 * @property string $extension 扩展名
 * @property string $size
 * @property string $dateline
 * @property int $view_num
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereAlbumid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereViewNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereWidth($value)
 * @mixin \Eloquent
 */
	class Material extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemDesc
 *
 * @property int $id
 * @property int $uid
 * @property int $itemid
 * @property string $content
 * @property string $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemDesc whereUpdateTime($value)
 * @mixin \Eloquent
 */
	class ItemDesc extends \Eloquent {}
}

namespace App\Models{
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
	class ShopRecord extends \Eloquent {}
}

namespace App\Models{
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
	class ItemImage extends \Eloquent {}
}

namespace App\Models{
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
	class ShopDesc extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ad
 *
 * @property int $id ID
 * @property int $uid
 * @property string $title 标题
 * @property string $type
 * @property string $begin_time
 * @property string $end_time
 * @property string $data
 * @property int $clicknum
 * @property int $available 是否可用
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereBeginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereClicknum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereUid($value)
 * @mixin \Eloquent
 */
	class Ad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderShipping
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property int $order_id 订单ID
 * @property int $express_id 快递公司ID
 * @property string $express_name 快递名称
 * @property string $express_no 快递单号
 * @property int $shipping_type 物流类型，1=快递，2=无需物流
 * @property string $shipping_time 发货时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereExpressNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereShippingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderShipping whereUid($value)
 * @mixin \Eloquent
 */
	class OrderShipping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int $uid 会员ID
 * @property float $balance 账户余额
 * @property float $total_income 累计收入
 * @property float $total_cost 累计支出
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallet whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallet whereTotalIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallet whereUid($value)
 * @mixin \Eloquent
 */
	class Wallet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\App
 *
 * @property int $id
 * @property string $appid
 * @property string $secret
 * @property string $name
 * @property string $version
 * @property string $url
 * @property string $status
 * @property string $access_token
 * @property string $expires_in
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereExpiresIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereVersion($value)
 * @mixin \Eloquent
 */
	class App extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostContent
 *
 * @property int $aid
 * @property int $uid
 * @property string $content
 * @property int $pageorder
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent wherePageorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostContent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PostContent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Settings
 *
 * @property string $skey 标识
 * @property string|null $svalue 值
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSkey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSvalue($value)
 * @mixin \Eloquent
 */
	class Settings extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Link
 *
 * @property int $id
 * @property int $catid
 * @property string $type
 * @property string $title
 * @property string $url
 * @property string $image
 * @property int $displayorder
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereUrl($value)
 * @mixin \Eloquent
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $order_id
 * @property int $buyer_uid 买家ID
 * @property string $buyer_name 买家账号
 * @property int $seller_uid 卖家ID
 * @property string $seller_name 卖家账号
 * @property int $shop_id 店铺ID
 * @property string $shop_name 店铺名称
 * @property string $order_no 订单编号
 * @property float $order_fee 订单费用
 * @property float $shipping_fee 运费
 * @property float $total_fee 总费用
 * @property int $pay_type 付款方式，1=在线支付，2=货到付款
 * @property int $pay_status 支付状态，1=已支付，0=未支付
 * @property string $pay_time 付款时间
 * @property int $shipping_type 配送方式，1=快递，2=物流，3=无需物流
 * @property int $shipping_status 发货状态，0=未发货，1=已发货
 * @property string $shipping_time 发货时间
 * @property int $receive_status 收货状态，0=未收货，1=已收货
 * @property int $review_status 评价状态，0=未评价，1=已评价
 * @property int $refund_status 退款状态，0=无退款，1=退款中，2=退款完成
 * @property string $create_time 创建时间
 * @property string $deal_time 成交时间
 * @property string $trade_no 交易流水号
 * @property string $remark 买家留言
 * @property string $consignee 收货人
 * @property string $phone 联系电话
 * @property string $address
 * @property int $is_commited 已提交需求
 * @property int $is_accepted 已受理
 * @property int $is_closed 关闭订单
 * @property int $is_deleted 已删除
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBuyerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereConsignee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDealTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsCommited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReceiveStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReviewStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSellerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShippingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTradeNo($value)
 * @mixin \Eloquent
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscribe
 *
 * @property int $id
 * @property int $uid
 * @property int $dataid
 * @property string $datatype
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereDataid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereDatatype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUid($value)
 * @mixin \Eloquent
 */
	class Subscribe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BlockItem
 *
 * @property int $id
 * @property int $block_id
 * @property string $title 标题
 * @property string $image 图片
 * @property string $url 链接
 * @property string $subtitle 副标题
 * @property string $field_1
 * @property string $field_2
 * @property string $field_3
 * @property int $displayorder 显示顺序
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereField3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BlockItem whereUrl($value)
 * @mixin \Eloquent
 */
	class BlockItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $address_id
 * @property int $uid
 * @property string $consignee
 * @property string $phone
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $street
 * @property string $postcode
 * @property int $isdefault
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereConsignee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUid($value)
 * @mixin \Eloquent
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemCatlog
 *
 * @property int $catid
 * @property int $fid 父级分类
 * @property string $name 分类名称
 * @property string $identifer
 * @property string $icon 图片
 * @property int $displayorder 显示顺序
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property string $keywords 关键字
 * @property string $description 描述
 * @property string $template_index 首页模板
 * @property string $template_list 列表页模板
 * @property string $template_detail 详细页模板
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereIdentifer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereTemplateList($value)
 * @mixin \Eloquent
 */
	class ItemCatlog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Express
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $regular
 * @property int $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereRegular($value)
 * @mixin \Eloquent
 */
	class Express extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemPush
 *
 * @property int $push_id
 * @property int $uid
 * @property int $itemid 商品ID
 * @property int $groupid
 * @property string $create_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereGroupid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereItemid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush wherePushId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPush whereUid($value)
 * @mixin \Eloquent
 */
	class ItemPush extends \Eloquent {}
}

namespace App\Models{
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
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Member
 *
 * @property int $uid
 * @property int $gid
 * @property int $adminid 管理员ID
 * @property int $admincp 是否允许登录后台
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $email 邮箱
 * @property string $mobile 手机号
 * @property int $status 状态
 * @property int $newpm 新消息
 * @property int $emailstatus 邮箱验证状态
 * @property int $avatarstatus 头像验证状态
 * @property int $freeze 冻结账户
 * @property int $exp 经验值，积分
 * @property int $exp1
 * @property int $exp2
 * @property int $exp3
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereAdmincp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereAdminid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereAvatarstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereEmailstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereNewpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUsername($value)
 * @mixin \Eloquent
 */
	class Member extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Shop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberStat
 *
 * @property int $uid
 * @property int $postnum
 * @property int $commentnum
 * @property int $albumnum
 * @property int $photonum
 * @property int $follower
 * @property int $following
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStat whereAlbumnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStat whereCommentnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStat whereFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStat whereFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStat wherePhotonum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStat wherePostnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStat whereUid($value)
 * @mixin \Eloquent
 */
	class MemberStat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostTag
 *
 * @property int $tag_id
 * @property string $tag_name
 * @property int $tag_num
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagNum($value)
 * @mixin \Eloquent
 */
	class PostTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemPushGroup
 *
 * @property int $groupid
 * @property string $grouptitle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPushGroup whereGroupid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemPushGroup whereGrouptitle($value)
 * @mixin \Eloquent
 */
	class ItemPushGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberStatus
 *
 * @property int $uid
 * @property string $regdate
 * @property string $regip
 * @property string $lastvisit
 * @property string $lastvisitip
 * @property string $lastactive
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStatus whereLastactive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStatus whereLastvisit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStatus whereLastvisitip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStatus whereRegdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStatus whereRegip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberStatus whereUid($value)
 * @mixin \Eloquent
 */
	class MemberStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberSession
 *
 * @property int $uid
 * @property string $session_id
 * @property string $session_value
 * @property int $expires_in
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberSession whereExpiresIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberSession whereSessionValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberSession whereUid($value)
 * @mixin \Eloquent
 */
	class MemberSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostItem
 *
 * @property int $aid 文章ID
 * @property int $uid 会员ID
 * @property string $username 用户名
 * @property int $catid 分类ID
 * @property string $author 作者
 * @property string $type 文章形式
 * @property string $title 文章标题
 * @property string $alias 别名
 * @property string $summary 摘要
 * @property string $image 图片
 * @property string $tags 标签
 * @property string $pubtime 发布时间
 * @property string $modified 修改时间
 * @property string $created_at
 * @property string $updated_at
 * @property int $allowcomment 允许评论
 * @property int $collection_num 被收藏数
 * @property int $comment_num 评论数
 * @property int $view_num 浏览数
 * @property int $like_num 点赞数
 * @property int $status
 * @property string $from 来源
 * @property string $fromurl 来源地址
 * @property int $contents 内容数
 * @property float $price 阅读价格
 * @property int $click1
 * @property int $click2
 * @property int $click3
 * @property int $click4
 * @property int $click5
 * @property int $click6
 * @property int $click7
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAllowcomment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCollectionNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCommentNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFromurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereLikeNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem wherePubtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereViewNum($value)
 * @mixin \Eloquent
 */
	class PostItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Block
 *
 * @property int $block_id
 * @property string $block_name
 * @property string $block_desc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereBlockName($value)
 * @mixin \Eloquent
 */
	class Block extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int $menuid
 * @property int $fid
 * @property string $name
 * @property string $url
 * @property string $type
 * @property string $icon
 * @property string $target
 * @property int $displayorder
 * @property int $available
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereMenuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUrl($value)
 * @mixin \Eloquent
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberInfo
 *
 * @property int $uid
 * @property int $usersex
 * @property string $birthday
 * @property int $blood
 * @property int $star
 * @property string $qq
 * @property string $weixin
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $town
 * @property string $street
 * @property string $introduction
 * @property string $tags
 * @property string $modified
 * @property int $locked
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereQq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereUsersex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberInfo whereWeixin($value)
 * @mixin \Eloquent
 */
	class MemberInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WeixinMenu
 *
 * @property int $id
 * @property int $fid
 * @property string $name
 * @property string $type
 * @property string $key
 * @property string $media_id
 * @property string $url
 * @property int $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinMenu whereUrl($value)
 * @mixin \Eloquent
 */
	class WeixinMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostCatlog
 *
 * @property int $catid
 * @property int $fid 父级分类
 * @property string $name 分类名称
 * @property string $identifer
 * @property string $icon 图片
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property int $displayorder 显示顺序
 * @property string $keywords 关键字
 * @property string $description 描述
 * @property string $template_index 首页模板
 * @property string $template_list 列表页模板
 * @property string $template_detail 详细页模板
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereIdentifer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCatlog whereTemplateList($value)
 * @mixin \Eloquent
 */
	class PostCatlog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Album
 *
 * @property int $albumid
 * @property int $uid
 * @property string $title
 * @property string $cover
 * @property string $password
 * @property int $is_open
 * @property int $view_num
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereAlbumid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereIsOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereViewNum($value)
 * @mixin \Eloquent
 */
	class Album extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderClosed
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property int $order_id 订单ID
 * @property string $close_reason 关闭原因
 * @property string $close_time 关闭时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereCloseReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereCloseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderClosed whereUid($value)
 * @mixin \Eloquent
 */
	class OrderClosed extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberGroup
 *
 * @property int $gid
 * @property string $title
 * @property string $type
 * @property int $creditslower
 * @property int $creditshigher
 * @property string $perm
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereCreditshigher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereCreditslower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup wherePerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereType($value)
 * @mixin \Eloquent
 */
	class MemberGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberToken
 *
 * @property int $uid 用户ID
 * @property string $token 令牌
 * @property string $expire_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberToken whereExpireTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberToken whereUid($value)
 * @mixin \Eloquent
 */
	class MemberToken extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberConnect
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property string $platform 平台
 * @property string $openid 开放ID
 * @property string $nickname 昵称
 * @property int $sex 性别
 * @property string $city 城市
 * @property string $province 省，州
 * @property string $country 国籍
 * @property string $headimgurl 头像地址
 * @property string $dateline 登录时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereHeadimgurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberConnect whereUid($value)
 * @mixin \Eloquent
 */
	class MemberConnect extends \Eloquent {}
}

namespace App\Models{
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
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Collection
 *
 * @property int $id
 * @property int $uid
 * @property int $dataid
 * @property string $datatype
 * @property string $title
 * @property string $image
 * @property string $create_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereDataid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereDatatype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereUid($value)
 * @mixin \Eloquent
 */
	class Collection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderAction
 *
 * @property int $action_id
 * @property int $uid 操作用户ID
 * @property string $username
 * @property int $order_id 订单ID
 * @property string $action_name 操作内容
 * @property string $action_time 操作时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereActionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereActionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderAction whereUsername($value)
 * @mixin \Eloquent
 */
	class OrderAction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostMedia
 *
 * @property int $id
 * @property int $aid
 * @property int $uid
 * @property string $image
 * @property string $source
 * @property string $original_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereOriginalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereUid($value)
 * @mixin \Eloquent
 */
	class PostMedia extends \Eloquent {}
}

namespace App\Models{
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
	class ShopAuth extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Verify
 *
 * @property int $id
 * @property string $seccode 验证码
 * @property string $phone 手机号
 * @property string $email 邮箱
 * @property string $dateline 发送时间
 * @property int $used 已使用
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereSeccode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereUsed($value)
 * @mixin \Eloquent
 */
	class Verify extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberLog
 *
 * @property int $id
 * @property int $uid
 * @property string $ip
 * @property string $operate
 * @property string $created_at
 * @property string $updated_at
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereOperate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class MemberLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property int $uid
 * @property string $username
 * @property string $contact
 * @property string $message
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUsername($value)
 * @mixin \Eloquent
 */
	class Feedback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostComment
 *
 * @property int $commid
 * @property int $aid
 * @property int $uid
 * @property string $username
 * @property int $reply_uid
 * @property string $reply_name
 * @property string $message
 * @property string $province
 * @property string $city
 * @property string $street
 * @property int $likes
 * @property int $status 审核状态
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCommid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereReplyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereReplyUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostComment whereUsername($value)
 * @mixin \Eloquent
 */
	class PostComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderRefund
 *
 * @property int $refund_id
 * @property int $buyer_uid
 * @property int $seller_uid
 * @property int $shop_id
 * @property int $order_id
 * @property string $refund_no
 * @property int $refund_type
 * @property int $refund_status
 * @property string $refund_reason
 * @property string $refund_desc
 * @property float $refund_fee 退款费用
 * @property string $refund_time
 * @property int $seller_accepted 卖家已受理
 * @property int $seller_accept_type 卖家处理类型，1=接收，2=拒绝
 * @property string $seller_accept_time
 * @property string $seller_reply_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereBuyerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereRefundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerAcceptTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerAcceptType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerReplyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereSellerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderRefund whereShopId($value)
 * @mixin \Eloquent
 */
	class OrderRefund extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Trade
 *
 * @property int $trade_id
 * @property int $payer_uid 付款方ID
 * @property string $payer_name 付款方账号
 * @property int $payee_uid 收款方ID
 * @property string $payee_name 收款方账户
 * @property string $pay_type 支付方式
 * @property int $pay_status 支付状态,0=未支付，1=已支付
 * @property string $trade_no 交易号
 * @property string $trade_name 交易名称
 * @property string $trade_desc 交易描述
 * @property float $trade_fee 交易金额
 * @property string $trade_type 交易类型
 * @property string $trade_status 交易状态
 * @property string $trade_time 交易时间
 * @property string $out_trade_no 第三方支付订单号
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade wherePayeeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade wherePayeeUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade wherePayerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade wherePayerUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade whereTradeType($value)
 * @mixin \Eloquent
 */
	class Trade extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MemberField
 *
 * @property int $field_id
 * @property int $uid
 * @property string $field
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberField whereField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberField whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberField whereValue($value)
 * @mixin \Eloquent
 */
	class MemberField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostImage
 *
 * @property int $id
 * @property int $aid 数据ID
 * @property int $uid
 * @property string $image
 * @property string $thumb
 * @property int $isremote
 * @property string $description
 * @property int $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereIsremote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostImage whereUid($value)
 * @mixin \Eloquent
 */
	class PostImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id ID
 * @property int $fid 父级ID
 * @property string $name 名称
 * @property int $level 级别
 * @property int $usetype 使用类型
 * @property int $displayorder 排序
 * @property string $zone_code
 * @property float $lng
 * @property float $lat
 * @property string $pinyin
 * @property string $letter
 * @property string $citycode 区号
 * @property string $zipcode 邮编
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCitycode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereUsetype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereZoneCode($value)
 * @mixin \Eloquent
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pages
 *
 * @property int $pageid
 * @property string $type
 * @property int $catid
 * @property string $title
 * @property string $alias
 * @property string $image
 * @property string $summary
 * @property string $body
 * @property string $template
 * @property int $displayorder
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages wherePageid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Pages extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostLog
 *
 * @property int $aid
 * @property int $uid
 * @property string $username
 * @property string $title
 * @property string $action_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereActionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUsername($value)
 * @mixin \Eloquent
 */
	class PostLog extends \Eloquent {}
}

