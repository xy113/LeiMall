<?php

namespace App\Models;

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
class MemberInfo extends BaseModel
{
    protected $table = 'member_info';
    protected $primaryKey = 'uid';
    public $timestamps = false;
}
