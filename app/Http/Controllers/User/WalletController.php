<?php

namespace App\Http\Controllers\User;

use App\Models\Trade;
use App\Models\Wallet;

class WalletController extends BaseController
{
    public function index(){
        $time = 0;
        $seconds = 86400;
        $condition = $params = [];
        $date_range = $this->request->get('date_range');
        $date_range = $date_range ? $date_range : 'all';
        if ($date_range == '3days'){
            $time = time() - $seconds*3;
        }elseif ($date_range == '7days'){
            $time = time() - $seconds*7;
        }elseif ($date_range == 'oneMonth'){
            $time = time() - $seconds*30;
        }elseif ($date_range == 'threeMonth'){
            $time = time() - $seconds*90;
        }elseif ($date_range == 'oneYear'){
            $time = time() - $seconds*365;
        }

        if ($time) $condition[] = ['created_at', '>', $time];
        if ($date_range != 'all') $params['date_range'] = $date_range;

        $trade_type = $this->request->get('trade_type');
        $trade_type = $trade_type ? $trade_type : 'all';
        if ($trade_type != 'all') {
            $condition[] = ['trade_type', '=', strtolower($trade_type)];
            $params['trade_type'] = $trade_type;
        }

        $pay_type = $this->request->get('pay_type');
        $pay_type = $pay_type ? $pay_type : 'all';
        if ($pay_type != 'all') {
            $condition[] = ['pay_type', '=', $pay_type];
            $params['pay_type'] = $pay_type;
        }

        $this->assign([
            'menu' => 'wallet',
            'wallet' => Wallet::getData($this->uid),
            'itemlist' => [],
            'q' => $this->request->get('q'),
            'date_range' => $date_range,
            'trade_type' => $trade_type,
            'pay_type' => $pay_type
        ]);

        $itemlist = Trade::where($condition)->where(function ($query){
            $query->where('payer_uid', $this->uid)->orWhere('payee_uid', $this->uid);
        })->orderByDesc('trade_id')->paginate(20);

        $this->assign([
            'pagination'=>$itemlist->appends($params)->links(),
            'totalCount'=>$itemlist->total(),
            'itemlist'=>[]
        ]);

        $pay_status = trans('mall.pay_status');
        $itemlist->map(function ($item) use ($pay_status){
            $item->trade_status_name = $pay_status[$item->pay_status];
            $this->data['itemlist'][$item->trade_id] = $item;
        });

        return $this->view('user.wallet');
    }
}
