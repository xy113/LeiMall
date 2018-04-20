<?php

namespace App\Models;

/**
 * App\Models\Album
 *
 * @property int $albumid
 * @property int $uid
 * @property string $title
 * @property string $cover
 * @property string $password
 * @property int $is_open
 * @property int $view_num
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereAlbumid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereIsOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Album whereViewNum($value)
 * @mixin \Eloquent
 */
class Album extends BaseModel
{
    protected $table = 'album';
    protected $primaryKey = 'albumid';
}
