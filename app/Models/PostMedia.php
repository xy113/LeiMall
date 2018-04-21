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
 * @property string $media_id
 * @property string $media_from
 * @property string $media_title
 * @property string $media_thumb
 * @property string $media_player
 * @property string $media_link
 * @property string $media_tags
 * @property string $media_description
 * @property string $media_source
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaPlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMedia whereMediaTitle($value)
 */
class PostMedia extends BaseModel
{
    protected $table = 'post_media';
    protected $primaryKey = 'id';
}
