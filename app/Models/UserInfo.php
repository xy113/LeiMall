<?php

namespace App\Models;

/**
 * App\Models\UserInfo
 *
 * @property int $uid
 * @property int $gender
 * @property string $birthday
 * @property int $blood
 * @property int $star
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $town
 * @property string $street
 * @property string $introduction
 * @property string $tags
 * @property string $created_at
 * @property string $updated_at
 * @property int $locked
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserInfo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserInfo extends BaseModel
{
    protected $table = 'user_info';
    protected $primaryKey = 'uid';
}
