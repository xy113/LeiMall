@extends('layouts.seller')

@section('title', '出售宝贝')

@section('content')
    <div class="navigation">
        <a>我是卖家</a>
        <span>></span>
        <a>宝贝管理</a>
        <span>></span>
        <a>出售宝贝</a>
    </div>
    <div class="content-div">
        <div class="form-div">
            <form method="post" id="publishForm" autocomplete="off">
                {{csrf_field()}}
                <input type="hidden" name="formsubmit" value="yes">
                <input type="hidden" name="catid" value="0" id="J_catid">
                <table cellspacing="0" cellpadding="0" class="cate-sascading" style="margin: 0 auto; width: 500px;">
                    <tbody>
                    <tr>
                        <td width="220">选择分类</td>
                        <td width="220">选择分类</td>
                    </tr>
                    <tr>
                        <td>
                            <select title="" class="select" size="20" id="catid_1"></select>
                        </td>
                        <td>
                            <select title="" class="select" size="20" id="catid_2"></select>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
                    <tfoot>
                    <tr>
                        <td style="text-align: center;"><button type="button" class="button btn-100" id="button-submit">发布宝贝</button></td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        var catlogList = @json($catlogList);
        function renderSelect(el, fid) {
            var options = '';
            $(catlogList[fid]).each(function () {
                options+= '<option value="'+this.catid+'">'+this.name+'</option>';
            });
            $(el).html(options);
        }
        renderSelect('#catid_1', 0);
        $("#catid_1").on('change', function () {
            var fid = $(this).val();
            renderSelect('#catid_2', fid);
        });
        $("#button-submit").on('click', function () {
            var catid = $("#catid_2").val();
            if (!catid){
                DSXUI.error('请选择宝贝分类');
                return false;
            }else {
                $("#J_catid").val(catid);
                $("#publishForm").submit();
            }
        });
    </script>
@stop
