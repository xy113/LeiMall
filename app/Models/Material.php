<?php

namespace App\Models;

/**
 * App\Models\Material
 *
 * @property int $id
 * @property int $uid
 * @property string $username
 * @property int $albumid 专辑ID，图片素材有效
 * @property string $name
 * @property string $path
 * @property string $thumb
 * @property string $width
 * @property string $height
 * @property string $type
 * @property string $extension 扩展名
 * @property string $size
 * @property string $dateline
 * @property int $view_num
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereAlbumid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereViewNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereWidth($value)
 * @mixin \Eloquent
 * @property string $source 存储路径
 * @property int $views
 * @property int $downloads
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereViews($value)
 */
class Material extends BaseModel
{
    protected $table = 'material';
    protected $primaryKey = 'id';
}
