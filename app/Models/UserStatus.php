<?php

namespace App\Models;

/**
 * App\Models\UserStatus
 *
 * @property int $uid
 * @property string $created_at
 * @property string $created_ip
 * @property string $lastvisit_at
 * @property string $lastvisit_ip
 * @property string $lastactive
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStatus whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStatus whereLastactive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStatus whereLastvisitAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStatus whereLastvisitIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStatus whereUid($value)
 * @mixin \Eloquent
 */
class UserStatus extends BaseModel
{
    protected $table = 'user_status';
    protected $primaryKey = 'uid';
}
