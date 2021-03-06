@extends('layouts.seller')

@section('title', '数据分析')

@section('content')
    <div class="navigation">
        <a>我是卖家</a>
        <span>></span>
        <a>店铺设置</a>
        <span>></span>
        <a>数据统计</a>
    </div>
    <div class="content-div">
        <div id="highcharts" style="height: 450px;"></div>
    </div>
    <script src="{{asset('js/highcharts.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('#highcharts').highcharts({
                chart: {
                    type: 'area'
                },
                title: {
                    text: '近30天店铺数据统计'
                },
                subtitle: {
                    text: null
                },
                xAxis: {
                    categories: {!! $days_json !!},
                    tickmarkPlacement: 'on',
                    title: {
                        enabled: false
                    }
                },
                yAxis: {
                    title: {
                        text: null
                    },
                    labels: {
                        //formatter: function () {
                        //    return this.value / 1000 + 'k';
                        //}
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}:{point.y:,.0f}'
                },
                plotOptions: {

                },
                series: [{
                    name: '访问量',
                    data: {!! $visit_json !!}
                }, {
                    name: '订单数',
                    data: {!! $order_json !!}
                },
                    {
                        name: '营业额',
                        data: {!! $turnovers_json !!}
                    }]
            });
        });
    </script>
@stop
