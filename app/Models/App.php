<?php

namespace App\Models;

/**
 * App\Models\App
 *
 * @property int $id
 * @property string $appid
 * @property string $secret
 * @property string $name
 * @property string $version
 * @property string $url
 * @property string $status
 * @property string $access_token
 * @property string $expires_in
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereExpiresIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereVersion($value)
 * @mixin \Eloquent
 */
class App extends BaseModel
{
    protected $table = 'app';
    protected $primaryKey = 'id';
}
