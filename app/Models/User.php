<?php

namespace App\Models;

/**
 * App\Models\User
 *
 * @property int $uid
 * @property int $gid
 * @property int $adminid 管理员ID
 * @property int $admincp 是否允许登录后台
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $email 邮箱
 * @property string $mobile 手机号
 * @property int $status 状态
 * @property int $newpm 新消息
 * @property int $emailstatus 邮箱验证状态
 * @property int $avatarstatus 头像验证状态
 * @property int $freeze 冻结账户
 * @property int $exp 经验值，积分
 * @property int $exp1
 * @property int $exp2
 * @property int $exp3
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAdmincp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAdminid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatarstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereExp1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereExp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereExp3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNewpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends BaseModel
{
    protected $table = 'user';
    protected $primaryKey = 'uid';
}
