<?php

namespace App\Models;

/**
 * App\Models\UserToken
 *
 * @property int $uid 用户ID
 * @property string $token 令牌
 * @property int $expires_in
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserToken whereExpiresIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserToken whereUid($value)
 * @mixin \Eloquent
 */
class UserToken extends BaseModel
{
    protected $table = 'user_token';
    protected $primaryKey = 'uid';
}
