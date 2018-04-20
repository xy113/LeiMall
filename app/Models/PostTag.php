<?php

namespace App\Models;

/**
 * App\Models\PostTag
 *
 * @property int $tag_id
 * @property string $tag_name
 * @property int $tag_num
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag whereTagNum($value)
 * @mixin \Eloquent
 */
class PostTag extends BaseModel
{
    protected $table = 'post_tag';
    protected $primaryKey = 'tag_id';
}
