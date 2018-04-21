<?php

namespace App\Models;

/**
 * App\Models\UserLog
 *
 * @property int $id
 * @property int $uid
 * @property string $username
 * @property string $ip
 * @property string $operate
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereOperate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLog whereUsername($value)
 * @mixin \Eloquent
 */
class UserLog extends BaseModel
{
    protected $table = 'user_log';
    protected $primaryKey = 'id';
}
