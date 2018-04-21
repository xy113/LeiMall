<?php

namespace App\Models;

/**
 * App\Models\UserGroup
 *
 * @property int $gid
 * @property string $title
 * @property string $type
 * @property int $creditslower
 * @property int $creditshigher
 * @property string $perm
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereCreditshigher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereCreditslower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup wherePerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereType($value)
 * @mixin \Eloquent
 */
class UserGroup extends BaseModel
{
    protected $table = 'user_group';
    protected $primaryKey = 'gid';
}
