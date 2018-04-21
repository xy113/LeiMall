<?php

namespace App\Models;

/**
 * App\Models\PostItem
 *
 * @property int $aid 文章ID
 * @property int $uid 会员ID
 * @property string $username 用户名
 * @property int $catid 分类ID
 * @property string $author 作者
 * @property string $type 文章形式
 * @property string $title 文章标题
 * @property string $alias 别名
 * @property string $summary 摘要
 * @property string $image 图片
 * @property string $tags 标签
 * @property string $pubtime 发布时间
 * @property string $modified 修改时间
 * @property string $created_at
 * @property string $updated_at
 * @property int $allowcomment 允许评论
 * @property int $collection_num 被收藏数
 * @property int $comment_num 评论数
 * @property int $view_num 浏览数
 * @property int $like_num 点赞数
 * @property int $status
 * @property string $from 来源
 * @property string $fromurl 来源地址
 * @property int $contents 内容数
 * @property float $price 阅读价格
 * @property int $click1
 * @property int $click2
 * @property int $click3
 * @property int $click4
 * @property int $click5
 * @property int $click6
 * @property int $click7
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAllowcomment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCatid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereClick7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCollectionNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCommentNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereFromurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereLikeNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem wherePubtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereViewNum($value)
 * @mixin \Eloquent
 * @property int $collections 被收藏数
 * @property int $comments 评论数
 * @property int $views 浏览数
 * @property int $likes 点赞数
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostItem whereViews($value)
 */
class PostItem extends BaseModel
{
    protected $table = 'post_item';
    protected $primaryKey = 'aid';

    /**
     * @param $aid
     * @throws \Exception
     */
    public static function deleteAll($aid){
        PostItem::where('aid', $aid)->delete();
        PostContent::where('aid', $aid)->delete();
        PostImage::where('aid', $aid)->delete();
        PostMedia::where('aid', $aid)->delete();
        PostLog::where('aid', $aid)->delete();
        PostComment::where('aid', $aid)->delete();
    }
}
