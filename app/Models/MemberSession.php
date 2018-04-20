<?php

namespace App\Models;

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
class MemberSession extends BaseModel
{
    protected $table = 'member_session';
    protected $primaryKey = 'uid';
    public $timestamps = false;
}
