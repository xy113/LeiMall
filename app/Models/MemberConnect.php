<?php

namespace App\Models;

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
class MemberConnect extends BaseModel
{
    protected $table = 'member_connect';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
