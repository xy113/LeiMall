<?php

namespace App\Models;

/**
 * App\Models\DeviceToken
 *
 * @property int $id
 * @property int $uid
 * @property string $ios_token
 * @property string $android_token
 * @property string $platform
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken whereAndroidToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken whereIosToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken whereUid($value)
 * @mixin \Eloquent
 */
class DeviceToken extends BaseModel
{
    protected $table = 'device_token';
    protected $primaryKey = 'id';
}
