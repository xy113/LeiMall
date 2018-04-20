<?php

namespace App\Models;

/**
 * App\Models\MemberGroup
 *
 * @property int $gid
 * @property string $title
 * @property string $type
 * @property int $creditslower
 * @property int $creditshigher
 * @property string $perm
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereCreditshigher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereCreditslower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup wherePerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberGroup whereType($value)
 * @mixin \Eloquent
 */
class MemberGroup extends BaseModel
{
    protected $table = 'member_group';
    protected $primaryKey = 'gid';
}
