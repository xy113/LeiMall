@extends('layouts.seller')

@section('title', '发布宝贝')

@section('content')
    <div class="navigation">
        <a>我是卖家</a>
        <span>></span>
        <a>宝贝管理</a>
        <span>></span>
        <a>发布宝贝</a>
    </div>
    <div class="content-div">
        <div class="form-div">
            <form method="post" id="publishForm" autocomplete="off">
                {{csrf_field()}}
                <input type="hidden" name="formsubmit" value="yes">
                <input type="hidden" name="catid" value="{$catid}">
                <input type="hidden" name="itemid" value="{$itemid}">
                <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
                    <tbody>
                    <tr>
                        <td class="cell-name" width="80">类目</td>
                        <td>
                            @if(isset($catloglist))
                                @foreach ($catloglist as $catlog)
                                    @if($loop->index>0)>@endif
                                    <span>{{$catlog['name']}}</span>
                                @endforeach
                            @endif
                            <span style="margin-left: 10px;"><a href="{{url('/seller/item/sell?itemid='.$itemid)}}" style="color: #0B90EF;">编辑类目</a></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name" width="80">宝贝名称</td>
                        <td><input title="" type="text" name="item[title]" id="title" class="input-text w300" value="{{$item['title']}}"></td>
                    </tr>
                    <tr>
                        <td class="cell-name">宝贝卖点</td>
                        <td>
                            <textarea title="" class="textarea w300" name="item[subtitle]">{{$item['subtitle']}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name">一口价</td>
                        <td><input title="" type="text" name="item[price]" id="price" class="input-text w300" value="{{$item['price']}}"></td>
                    </tr>
                    <tr>
                        <td class="cell-name">库存数量</td>
                        <td><input title="" type="text" name="item[stock]" id="stock" class="input-text w300" value="{{$item['stock']}}"></td>
                    </tr>
                    <tr>
                        <td class="cell-name">宝贝图片</td>
                        <td>第一张为宝贝主图，主图不能超过3MB，仅支持上传JPG格式的图片</td>
                    </tr>
                    <tr>
                        <td class="cell-name"></td>
                        <td>
                            <ul class="item-image-list" id="item-image-list">
                                <li>
                                    <input type="hidden" name="gallery[0][id]" value="{{$gallery[0]['id']}}">
                                    <input type="hidden" class="thumb" name="gallery[0][thumb]" value="{{$gallery[0]['thumb']}}">
                                    <input type="hidden" class="image" name="gallery[0][image]" value="{{$gallery[0]['image']}}">
                                    <span class="iconfont icon-add"></span>
                                    <div class="bg-cover preview" style="background-image: url({{image_url($gallery[0]['thumb'])}});"></div>
                                </li>
                                <li>
                                    <input type="hidden" name="gallery[1][id]" value="{{$gallery[1]['id']}}">
                                    <input type="hidden" class="thumb" name="gallery[1][thumb]" value="{{$gallery[1]['thumb']}}">
                                    <input type="hidden" class="image" name="gallery[1][image]" value="{{$gallery[1]['image']}}">
                                    <span class="iconfont icon-add"></span>
                                    <div class="bg-cover preview" style="background-image: url({{image_url($gallery[1]['thumb'])}});"></div>
                                </li>
                                <li>
                                    <input type="hidden" name="gallery[2][id]" value="{{$gallery[2]['id']}}">
                                    <input type="hidden" class="thumb" name="gallery[2][thumb]" value="{{$gallery[2]['thumb']}}">
                                    <input type="hidden" class="image" name="gallery[2][image]" value="{{$gallery[2]['image']}}">
                                    <span class="iconfont icon-add"></span>
                                    <div class="bg-cover preview" style="background-image: url({{image_url($gallery[2]['thumb'])}});"></div>
                                </li>
                                <li>
                                    <input type="hidden" name="gallery[3][id]" value="{{$gallery[3]['id']}}">
                                    <input type="hidden" class="thumb" name="gallery[3][thumb]" value="{{$gallery[3]['thumb']}}">
                                    <input type="hidden" class="image" name="gallery[3][image]" value="{{$gallery[3]['image']}}">
                                    <span class="iconfont icon-add"></span>
                                    <div class="bg-cover preview" style="background-image: url({{image_url($gallery[3]['thumb'])}});"></div>
                                </li>
                                <li>
                                    <input type="hidden" name="gallery[4][id]" value="{{$gallery[4]['id']}}">
                                    <input type="hidden" class="thumb" name="gallery[4][thumb]" value="{{$gallery[4]['thumb']}}">
                                    <input type="hidden" class="image" name="gallery[4][image]" value="{{$gallery[4]['image']}}">
                                    <span class="iconfont icon-add"></span>
                                    <div class="bg-cover preview" style="background-image: url({{image_url($gallery[4]['thumb'])}});"></div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name">宝贝详情</td>
                        <td>
                            @include('common.editor', ['name' => 'content', 'content'=>$content['content'], 'params'=>[]])
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name">运费</td>
                        <td><input title="" type="text" name="item[shipping_fee]" id="shipping_fee" class="input-text w300" value="{{$item['shipping_fee']}}"></td>
                    </tr>
                    <tr>
                        <td class="cell-name">上架时间</td>
                        <td>
                            <label><input type="radio" class="radio" name="item[on_sale]" value="1"@if($item['on_sale']) checked="checked"@endif> <span>立即上架</span></label>
                            <label><input type="radio" class="radio" name="item[on_sale]" value="0"@if(!$item['on_sale']) checked="checked"@endif> <span>存入仓库</span></label>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td width="80"></td>
                        <td><button type="submit" class="button btn-100">立即发布</button></td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        window.onbeforeunload = function () {
            if (confirm("你填写的信息尚未保存，是否确认要离开此页面")){

            }else {
                return false;
            }
        };
        $(function () {
            $("#item-image-list li").on('click', function () {
                var self = $(this);
                DSXUI.showImagePicker(function (data) {
                    self.find('.preview').css({'background-image':'url('+data.imageurl+')'});
                    self.find('.thumb').val(data.thumb);
                    self.find('.image').val(data.image);
                });
            });
            $("#publishForm").on('submit', function () {
                window.onbeforeunload = null;
                var title = $.trim($("#title").val());
                if (!title) {
                    DSXUI.error('请填写宝贝名称');
                    return false;
                }
                var price = $.trim($("#price").val());
                if (!price) {
                    DSXUI.error('请填写产品价格');
                    return false;
                }
                var stock = $.trim($("#stock").val());
                if (!stock) {
                    DSXUI.error('请填写产品库存');
                    return false;
                }
            });
        });
    </script>
@stop
