<?php

namespace App\Models;

/**
 * App\Models\Subscribe
 *
 * @property int $id
 * @property int $uid
 * @property int $dataid
 * @property string $datatype
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereDataid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereDatatype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscribe whereUid($value)
 * @mixin \Eloquent
 */
class Subscribe extends BaseModel
{
    protected $table = 'subscribe';
    protected $primaryKey = 'id';
}
