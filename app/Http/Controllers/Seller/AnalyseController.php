<?php

namespace App\Http\Controllers\Seller;

use App\Models\Shop;
use App\Models\ShopRecord;
use Illuminate\Http\Request;

class AnalyseController extends BaseController
{
    /**
     * AnalyseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->assign(['menu'=>'analyse']);
    }

    /**
     * 门店销售统计
     */
    public function index(){
        global $_G,$_lang;

        $i = 0;
        $days = $days_data = array();
        while ($i < 30){
            $days[] = date('Ymd', strtotime("-$i day"));
            $days_data[] = date('m/d', strtotime("-$i day"));
            $i++;
        }
        $days = array_reverse($days);
        $shop = Shop::where('uid', $this->uid)->first();
        $record_list = ShopRecord::where('shop_id', $shop->shop_id)->whereIn('datestamp', $days)->get();

        $datalist = array();
        foreach ($days as $day){
            $datalist[$day] = array(
                'shop_id'=>$shop->shop_id,
                'orders'=>0,
                'visits'=>0,
                'turnovers'=>0
            );
        }
        foreach ( $record_list as $record){
            $datalist[$record['datestamp']] = array(
                'orders'=>$record['orders'],
                'visits'=>$record['visits'],
                'turnovers'=>$record['turnovers']
            );
        }
        unset($i, $days, $day, $record_list, $record);
        $visit_data = $order_data = $turnovers_data = array();
        foreach ($datalist as $data){
            $visit_data[] = intval($data['visits']);
            $order_data[] = intval($data['orders']);
            $turnovers_data[] = floatval($data['turnovers']);
        }
        $days_json = json_encode(array_reverse($days_data));
        $visit_json = json_encode($visit_data);
        $order_json = json_encode($order_data);
        $turnovers_json = json_encode($turnovers_data);

        $this->assign([
            'shop'=>$shop,
            'days_json'=>$days_json,
            'visit_json'=>$visit_json,
            'order_json'=>$order_json,
            'turnovers_json'=>$turnovers_json
        ]);

        return $this->view('seller.shop.analyse');
    }
}
