<?php

namespace App\Models;


/**
 * App\Models\Collection
 *
 * @property int $id
 * @property int $uid
 * @property int $dataid
 * @property string $datatype
 * @property string $title
 * @property string $image
 * @property string $create_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereDataid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereDatatype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereUid($value)
 * @mixin \Eloquent
 */
class Collection extends BaseModel
{
    protected $table = 'collection';
    protected $primaryKey = 'id';
}
