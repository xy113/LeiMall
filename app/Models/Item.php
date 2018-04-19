<?php

namespace App\Models;

class Item extends BaseModel
{
    protected $table = 'item';
    protected $primaryKey = 'itemid';

    /**
     * @param $itemid
     * @throws \Exception
     */
    public static function deleteItem($itemid) {
        $condition = ['itemid'=>$itemid];
        Item::where($condition)->delete();
        ItemImage::where($condition)->delete();
        ItemDesc::where($condition)->delete();
        ItemPush::where($condition)->delete();
        Collection::where(['datatype'=>'item', 'dataid'=>$itemid])->delete();
    }
}
