<?php

namespace App\Models;

/**
 * App\Models\PostLog
 *
 * @property int $aid
 * @property int $uid
 * @property string $username
 * @property string $title
 * @property string $action_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereActionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLog whereUsername($value)
 * @mixin \Eloquent
 */
class PostLog extends BaseModel
{
    protected $table = 'post_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
