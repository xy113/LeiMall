<?php

namespace App\Models;

/**
 * App\Models\MemberLog
 *
 * @property int $id
 * @property int $uid
 * @property string $ip
 * @property string $operate
 * @property string $created_at
 * @property string $updated_at
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereOperate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MemberLog extends BaseModel
{
    protected $table = 'member_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
