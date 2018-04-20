<?php

namespace App\Models;

/**
 * App\Models\PostMedia
 *
 * @property int $id
 * @property int $aid
 * @property int $uid
 * @property string $image
 * @property string $source
 * @property string $original_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereOriginalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereUid($value)
 * @mixin \Eloquent
 */
class PostMedia extends BaseModel
{
    protected $table = 'post_media';
    protected $primaryKey = 'id';
}
