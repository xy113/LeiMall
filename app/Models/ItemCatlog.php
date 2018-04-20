<?php

namespace App\Models;

/**
 * App\Models\ItemCatlog
 *
 * @property int $catid
 * @property int $fid 父级分类
 * @property string $name 分类名称
 * @property string $identifer
 * @property string $icon 图片
 * @property int $displayorder 显示顺序
 * @property int $level 级别
 * @property int $enable 是否可选
 * @property int $available 是否可用
 * @property string $keywords 关键字
 * @property string $description 描述
 * @property string $template_index 首页模板
 * @property string $template_list 列表页模板
 * @property string $template_detail 详细页模板
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereIdentifer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereTemplateDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereTemplateIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemCatlog whereTemplateList($value)
 * @mixin \Eloquent
 */
class ItemCatlog extends BaseModel
{
    protected $table = 'item_catlog';
    protected $primaryKey = 'catid';
}
