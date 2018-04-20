<?php

namespace App\Models;

/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property int $uid
 * @property string $username
 * @property string $contact
 * @property string $message
 * @property string $dateline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereDateline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUsername($value)
 * @mixin \Eloquent
 */
class Feedback extends BaseModel
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';
}
