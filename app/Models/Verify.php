<?php

namespace App\Models;

/**
 * App\Models\Verify
 *
 * @property int $id
 * @property string $seccode 验证码
 * @property string $phone 手机号
 * @property string $email 邮箱
 * @property string $dateline 发送时间
 * @property int $used 已使用
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereSeccode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereUsed($value)
 * @mixin \Eloquent
 * @property string $code 验证码
 * @property int $created_at 发送时间
 * @property int $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Verify whereUpdatedAt($value)
 */
class Verify extends BaseModel
{
    protected $table = 'verify';
    protected $primaryKey = 'id';
}
