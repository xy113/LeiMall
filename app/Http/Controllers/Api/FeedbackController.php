<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;

class FeedbackController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(){
        $title = $this->request->input('title');
        $message = $this->request->input('message');

        if ($title && $message) {
            $id = Feedback::insertGetId([
                'uid'=>$this->uid,
                'username'=>$this->username,
                'title'=>$title,
                'message'=>$message,
                'created_at'=>time()
            ]);

            return ajaxReturn(['id'=>$id]);
        }else{
            return ajaxReturn(['id'=>0]);
        }
    }
}
