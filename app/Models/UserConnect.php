<?php

namespace App\Models;

/**
 * App\Models\UserConnect
 *
 * @property int $id
 * @property int $uid 用户ID
 * @property string $platform 平台
 * @property string $openid 开放ID
 * @property string $nickname 昵称
 * @property int $gender 性别
 * @property string $city 城市
 * @property string $province 省，州
 * @property string $country 国籍
 * @property string $headimg 头像地址
 * @property int $created_at 登录时间
 * @property int $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereHeadimg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConnect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserConnect extends BaseModel
{
    protected $table = 'user_connect';
    protected $primaryKey = 'id';
}
