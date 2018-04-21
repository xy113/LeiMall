<?php

namespace App\Models;

/**
 * App\Models\UserStat
 *
 * @property int $uid
 * @property int $posts
 * @property int $comments
 * @property int $albums
 * @property int $photos
 * @property int $follower
 * @property int $following
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereAlbums($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat wherePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserStat whereUid($value)
 * @mixin \Eloquent
 */
class UserStat extends BaseModel
{
    protected $table = 'user_stat';
    protected $primaryKey = 'uid';
}
