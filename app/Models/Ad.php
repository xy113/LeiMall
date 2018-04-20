<?php

namespace App\Models;

/**
 * App\Models\Ad
 *
 * @property int $id ID
 * @property int $uid
 * @property string $title 标题
 * @property string $type
 * @property string $begin_time
 * @property string $end_time
 * @property string $data
 * @property int $clicknum
 * @property int $available 是否可用
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereBeginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereClicknum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ad whereUid($value)
 * @mixin \Eloquent
 */
class Ad extends BaseModel
{
    protected $table = 'ad';
    protected $primaryKey = 'id';
}
