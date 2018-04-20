<?php

namespace App\Models;

/**
 * App\Models\Member
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereAdmincp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereAdminid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereAvatarstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereEmailstatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereExp3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereNewpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereUsername($value)
 * @mixin \Eloquent
 */
class Member extends BaseModel
{
    protected $table = 'member';
    protected $primaryKey = 'uid';
    public $timestamps = false;

    /**
     * @param $uid
     * @throws \Exception
     */
    public static function deleteAll($uid){
        Member::where('uid', $uid)->delete();
        MemberToken::where('uid', $uid)->delete();
        MemberConnect::where('uid', $uid)->delete();
        MemberStatus::where('uid', $uid)->delete();
        MemberStat::where('uid', $uid)->delete();
        MemberLog::where('uid', $uid)->delete();
        MemberField::where('uid', $uid)->delete();
        MemberInfo::where('uid', $uid)->delete();
    }
}
