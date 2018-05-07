<?php

namespace App\Http\Controllers\Admin;

use App\Models\AttributeOption;
use App\Models\AttributeType;

class AttributeController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(){

        if ($this->isOnSubmit()){
            $delete = $this->request->input('delete');
            if ($delete) {
                foreach ($delete as $typeid){
                    AttributeType::where('typeid', $typeid)->delete();
                    AttributeOption::where('typeid', $typeid)->delete();
                }
            }
            return ajaxReturn();
        }else {

            $condition = [];
            $q = $this->request->get('q');
            if ($q) $condition = ['name', 'LIKE', "%$q%"];

            $typelist = AttributeType::where($condition)->orderBy('typeid')->paginate(20);
            $this->assign([
                'q'=>$q,
                'pagination'=>$q ? $typelist->appends(['q'=>$q])->links() : $typelist->links(),
                'typelist'=>$typelist
            ]);

            return $this->view('admin.attribute.types');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function savetype(){
        $typeid = $this->request->input('typeid');
        $typename = $this->request->input('typename');
        if ($typeid) {
            AttributeType::where('typeid', $typeid)->update(['typename'=>$typename]);
        }else {
            $typeid = AttributeType::insertGetId(['typename'=>$typename]);
        }
        return ajaxReturn(['typeid'=>$typeid]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function option(){

        $typeid = $this->request->input('typeid');
        if ($this->isOnSubmit()) {
            $delete = $this->request->post('delete');
            if ($delete && is_array($delete)) {
                foreach ($delete as $optionid) {
                    AttributeOption::where('optionid', $optionid)->delete();
                }
            }

            $optionlist = $this->request->post('optionlist');
            if ($optionlist) {
                foreach ($optionlist as $optionid=>$option) {
                    $option['required'] = isset($option['required']) ? 1 : 0;
                    AttributeOption::where('optionid', $optionid)->update($option);
                }
            }
            return ajaxReturn(['retrun_code'=>0]);
        }else {

            $this->assign([
                'typeid'=>$typeid,
                'type'=>AttributeType::where('typeid', $typeid)->first(),
                'optionlist'=>AttributeOption::where('typeid', $typeid)->orderBy('displayorder')->get(),
                'option_types'=>trans('common.attribute_option_types'),
                'typelist'=>AttributeType::all()
            ]);

            return $this->view('admin.attribute.option');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newoption(){

        $typeid = $this->request->get('typeid');
        $optionid = $this->request->get('optionid');
        if ($this->isOnSubmit()) {
            $option = $this->request->post('option');
            if ($option['title'] && $option['identifier']) {
                $rules = $this->request->post('rules');
                $option['rules'] = serialize($rules);

                if ($optionid) {
                    AttributeOption::where('optionid', $optionid)->update($option);
                }else {
                    $option['typeid'] = $typeid;
                    AttributeOption::insert($option);
                }
            }
            return $this->showSuccess(trans('ui.save_succeed'), null, [
                ['text'=>trans('common.continue_add'), 'url'=>url()->current()],
                ['text'=>trans('common.back_list'), 'url'=>url('admin/attribute/option?typeid='.$typeid)]
            ]);
        }else {

            $this->assign([
                'typeid'=>$typeid,
                'optionid'=>$optionid,
                'option'=>[
                    'typeid'=>$typeid,
                    'title'=>'',
                    'description'=>'',
                    'identifier'=>'',
                    'type'=>'text',
                    'rules'=>'',
                    'required'=>0,
                    'displayorder'=>0
                ],
                'rules'=>[
                    'text'=>[
                        'default'=>'',
                        'minlength'=>'',
                        'maxlength'=>''
                    ],
                    'textarea'=>[
                        'default'=>'',
                        'minlength'=>'',
                        'maxlength'=>'',
                        'width'=>'',
                        'height'=>''
                    ],
                    'select'=>[
                        'default'=>'',
                        'options'=>''
                    ],
                    'mutiselect'=>[
                        'default'=>'',
                        'options'=>'',
                        'width'=>'',
                        'height'=>''
                    ],
                    'radio'=>[
                        'default'=>'',
                        'options'=>''
                    ],
                    'checkbox'=>[
                        'default'=>'',
                        'options'=>''
                    ],
                    'number'=>[
                        'default'=>'',
                        'min'=>'',
                        'max'=>''
                    ],
                    'money'=>[
                        'default'=>'',
                        'min'=>'',
                        'max'=>''
                    ],
                    'image'=>[
                        'default'=>'',
                        'width'=>'',
                        'height'=>''
                    ],
                    'calendar'=>[
                        'default'=>''
                    ]
                ]
            ]);

            if ($optionid) {
                $option = AttributeOption::where('optionid', $optionid)->first();
                if ($option) {
                    $this->assign(['option'=>$option]);
                    $rules = unserialize($option->rules);
                    $this->data['rules'][$option->type] = $rules[$option->type];
                }
            }

            return $this->view('admin.attribute.newoption');
        }
    }

    public function fetchrules(){

        $type = $this->request->get('type') or 'text';
        $optionid = $this->request->get('optionid');

        $this->assign([
            'text'=>[
                'minlength'=>'',
                'maxlength'=>''
            ],
            'textarea'=>[
                'minlength'=>'',
                'maxlength'=>'',
                'rows'=>'',
                'width'=>'',
                'height'=>''
            ]
        ]);

        if ($optionid) {
            $option = AttributeOption::where('optionid', $optionid)->first();
            if ($option) {
                $rules = unserialize($option->rules);
                if (isset($rules[$type])) {
                    $this->assign([
                        $type=>$rules[$type]
                    ]);
                }
            }
        }

        return $this->view('admin.attribute.rules_'.$type);
    }
}
