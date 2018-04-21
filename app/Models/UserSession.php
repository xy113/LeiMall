<?php

namespace App\Models;

/**
 * App\Models\UserSession
 *
 * @property int $uid
 * @property string $session_id
 * @property string $session_value
 * @property int $expires_in
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereExpiresIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereSessionValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereUid($value)
 * @mixin \Eloquent
 */
class UserSession extends BaseModel
{
    protected $table = 'user_session';
    protected $primaryKey = 'uid';
}
