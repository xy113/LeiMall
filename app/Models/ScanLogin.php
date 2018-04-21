<?php

namespace App\Models;

/**
 * App\Models\ScanLogin
 *
 * @property int $id
 * @property int $uid
 * @property string $code
 * @property int $used
 * @property int $created_at
 * @property int $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScanLogin whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScanLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScanLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScanLogin whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScanLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScanLogin whereUsed($value)
 * @mixin \Eloquent
 */
class ScanLogin extends BaseModel
{
    protected $table = 'scan_login';
    protected $primaryKey = 'id';
}
