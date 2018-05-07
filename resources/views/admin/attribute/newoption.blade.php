@extends('layouts.admin')

@section('title', '编辑项目')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{url('admin/attribute/option?typeid='.$typeid)}}" class="btn btn-primary">
                返回项目列表
            </a>
        </div>
        <h2>分类属性管理->项目管理->@if($optionid)编辑项目@else添加项目@endif</h2>
    </div>

    <div class="content-div">
        <form method="post" id="Form">
            {{form_verify_field()}}
            <table class="formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody id="basic">
                <tr>
                    <td class="cell-label" width="60">标题:</td>
                    <td width="320" class="cell-input"><input title="" name="option[title]" value="{{$option['title']}}" class="form-control w300" type="text"></td>
                    <td>项目名称</td>
                </tr>
                <tr>
                    <td class="cell-label">描述:</td>
                    <td class="cell-input"><textarea title="" name="option[description]" class="form-control w300" style="height: 60px;">{{$option['description']}}</textarea></td>
                    <td>项目描述</td>
                </tr>
                <tr>
                    <td class="cell-label">字段名:</td>
                    <td class="cell-input"><input title="" name="option[identifier]" class="form-control w300" value="{{$option['identifier']}}" type="text"></td>
                    <td>字段名，只能是英文字母和下划线</td>
                </tr>
                <tr>
                    <td class="cell-label">必填:</td>
                    <td class="cell-content">
                        <label><input name="option[required]" value="1" type="radio"@if ($option['required']) checked="checked"@endif> 是</label>
                        <label><input name="option[required]" value="0" type="radio"@if (!$option['required']) checked="checked"@endif> 否</label>
                    </td>
                    <td>是否必填项</td>
                </tr>
                <tr>
                    <td class="cell-label">类型</td>
                    <td class="cell-input">
                        <select title="" class="form-control w300" name="option[type]" id="type">
                            @foreach(trans('common.attribute_option_types') as $k=>$v)
                                <option value="{{$k}}"@if($k===$option['type']) selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>输入方式</td>
                </tr>
                </tbody>
                <tbody id="rules"></tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><input type="submit" class="btn btn-primary" value="保存"></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/html" id="rules_text">
        <tr>
            <td class="cell-label">默认值</td>
            <td><input title="" name="rules[text][default]" value="{{$rules['text']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认值, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最小长度</td>
            <td><input title="" name="rules[text][minlength]" value="{{$rules['text']['minlength']}}" class="form-control w300" type="text"></td>
            <td>字段要求最小长度, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最大长度</td>
            <td><input title="" name="rules[text][maxlength]" value="{{$rules['text']['maxlength']}}" class="form-control w300" type="text"></td>
            <td>字段要求最大长度, 可选</td>
        </tr>
    </script>

    <script type="text/html" id="rules_textarea">
        <tr>
            <td class="cell-label">默认值</td>
            <td><input title="" name="rules[textarea][default]" value="{{$rules['textarea']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认值, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最小长度</td>
            <td><input title="" name="rules[textarea][minlength]" value="{{$rules['textarea']['minlength']}}" class="form-control w300" type="text"></td>
            <td>字段要求最小长度, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最大长度</td>
            <td><input title="" name="rules[textarea][maxlength]" value="{{$rules['textarea']['maxlength']}}" class="form-control w300" type="text"></td>
            <td>字段要求最大长度, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">文本域宽</td>
            <td><input title="" name="rules[textarea][width]" value="{{$rules['textarea']['width']}}" class="form-control w300" type="text"></td>
            <td>文本域宽度, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">文本域高</td>
            <td><input title="" name="rules[textarea][width]" value="{{$rules['textarea']['width']}}" class="form-control w300" type="text"></td>
            <td>文本域高度, 可选</td>
        </tr>
    </script>
    <script type="text/html" id="rules_select">
        <tr>
            <td class="cell-label">默认选项</td>
            <td><input title="" name="rules[select][default]" value="{{$rules['select']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认选项, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">选项列表</td>
            <td>
                <textarea title="" name="rules[select][options]" class="form-control w300" style="height: 100px;">{{$rules['select']['options']}}</textarea>
            </td>
            <td>以键=值的形式，每行一个，如：<br>1=鼠标<br>2=键盘</td>
        </tr>
    </script>
    <script type="text/html" id="rules_mutiselect">
        <tr>
            <td class="cell-label">默认选项</td>
            <td><input title="" name="rules[mutiselect][default]" value="{{$rules['mutiselect']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认选项, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">选项列表</td>
            <td>
                <textarea title="" name="rules[mutiselect][options]" class="form-control w300" style="height: 100px;">{{$rules['mutiselect']['options']}}</textarea>
            </td>
            <td>以键=值的形式，每行一个，如：<br>1=鼠标<br>2=键盘</td>
        </tr>
        <tr>
            <td class="cell-label">选择域宽</td>
            <td><input title="" name="rules[mutiselect][width]" value="{{$rules['mutiselect']['width']}}" class="form-control w300" type="text"></td>
            <td>选择域宽度, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">选择域高</td>
            <td><input title="" name="rules[mutiselect][width]" value="{{$rules['mutiselect']['width']}}" class="form-control w300" type="text"></td>
            <td>选择域高度, 可选</td>
        </tr>
    </script>
    <script type="text/html" id="rules_radio">
        <tr>
            <td class="cell-label">默认选项</td>
            <td><input title="" name="rules[radio][default]" value="{{$rules['radio']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认选项, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">选项列表</td>
            <td>
                <textarea title="" name="rules[radio][options]" class="form-control w300" style="height: 100px;">{{$rules['radio']['options']}}</textarea>
            </td>
            <td>以键=值的形式，每行一个，如：<br>1=鼠标<br>2=键盘</td>
        </tr>
    </script>
    <script type="text/html" id="rules_checkbox">
        <tr>
            <td class="cell-label">默认选项</td>
            <td><input title="" name="rules[checkbox][default]" value="{{$rules['checkbox']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认选项, 多个选项以半角","号隔开, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">选项列表</td>
            <td>
                <textarea title="" name="rules[checkbox][options]" class="form-control w300" style="height: 100px;">{{$rules['checkbox']['options']}}</textarea>
            </td>
            <td>以键=值的形式，每行一个，如：<br>1=鼠标<br>2=键盘</td>
        </tr>
    </script>
    <script type="text/html" id="rules_number">
        <tr>
            <td class="cell-label">默认值</td>
            <td><input title="" name="rules[number][default]" value="{{$rules['number']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认值, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最小值</td>
            <td><input title="" name="rules[number][min]" value="{{$rules['number']['min']}}" class="form-control w300" type="text"></td>
            <td>字段要求最小值, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最大值</td>
            <td><input title="" name="rules[number][max]" value="{{$rules['number']['max']}}" class="form-control w300" type="text"></td>
            <td>字段要求最大值, 可选</td>
        </tr>
    </script>
    <script type="text/html" id="rules_money">
        <tr>
            <td class="cell-label">默认值</td>
            <td><input title="" name="rules[money][default]" value="{{$rules['money']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认值, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最小金额</td>
            <td><input title="" name="rules[money][min]" value="{{$rules['money']['min']}}" class="form-control w300" type="text"></td>
            <td>字段要求最小值, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">最大金额</td>
            <td><input title="" name="rules[money][max]" value="{{$rules['money']['max']}}" class="form-control w300" type="text"></td>
            <td>字段要求最大值, 可选</td>
        </tr>
    </script>
    <script type="text/html" id="rules_image">
        <tr>
            <td class="cell-label">默认图片</td>
            <td><input title="" name="rules[image][default]" value="{{$rules['image']['default']}}" class="form-control w300" type="text"></td>
            <td>默认图片, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">图片宽</td>
            <td><input title="" name="rules[image][width]" value="{{$rules['image']['width']}}" class="form-control w300" type="text"></td>
            <td>图片宽度, 可选</td>
        </tr>
        <tr>
            <td class="cell-label">图片高</td>
            <td><input title="" name="rules[image][height]" value="{{$rules['image']['height']}}" class="form-control w300" type="text"></td>
            <td>图片高度, 可选</td>
        </tr>
    </script>
    <script type="text/html" id="rules_calendar">
        <tr>
            <td class="cell-label">默认日期</td>
            <td><input title="" name="rules[calendar][default]" value="{{$rules['calendar']['default']}}" class="form-control w300" type="text"></td>
            <td>字段默认值, 可选</td>
        </tr>
    </script>
    <script type="text/javascript">
        (function () {
            function showType(type) {
                $("#rules").html($("#rules_"+type).html());
            }
            var type = $("#type").val();
            showType(type);

            $("#type").on('change', function () {
                showType($(this).val());
            });
        })();
    </script>
@stop
