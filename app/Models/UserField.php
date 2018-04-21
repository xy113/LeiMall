<?php

namespace App\Models;

/**
 * App\Models\UserField
 *
 * @property int $id
 * @property int $uid
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserField whereValue($value)
 * @mixin \Eloquent
 */
class UserField extends BaseModel
{
    protected $table = 'user_field';
    protected $primaryKey = 'id';
}
