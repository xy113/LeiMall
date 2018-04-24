<?php

namespace App\Http\Controllers\User;

use App\Models\Collection;

class CollectionController extends BaseController
{
    public function index($type = 'article'){

        $q = $this->request->get('q');
        $this->assign([
            'menu' => 'collection',
            'tab' => $type,
            'q' => $q
        ]);
        $condition = $q ? [['title', 'LIKE', $q]] : [];

        $collections = Collection::where('uid', $this->uid)
            ->where('datatype', $type)->where($condition)->paginate(20);
        $this->assign(['pagination'=>$collections->appends(['q'=>$q])->links()]);

        $itemlist = [];
        foreach ($collections as $c) {
            $itemlist[$c->id] = $c;
        }
        $this->assign(['itemlist' => $itemlist]);

        return $this->view('user.collection.'.$type);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(){
        $id = $this->request->get('id');
        Collection::where('uid', $this->uid)->where('id', $id)->delete();
        return ajaxReturn();
    }
}
