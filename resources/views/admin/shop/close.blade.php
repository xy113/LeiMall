<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{$_G[title]}-后台管理中心</title>
    <meta name="keywords" content="{$_G[keywords]}">
    <meta name="description" content="{$_G[description]}">
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" href="/static/images/common/favicon.png">
    <link rel="stylesheet" type="text/css" href="/static/css/admin.css">
    <script src="/static/js/jquery.js" type="text/javascript"></script>
    <script src="/static/js/common.js" type="text/javascript"></script>
</head>
<body style="padding: 20px; overflow: hidden;">
<form method="post" id="closeForm">
    <input type="hidden" name="formhash" value="{FORMHASH}">
    <input type="hidden" name="formsubmit" value="yes">
    <input type="hidden" name="shops" value="{$_GET[shops]}">
    <table cellpadding="0" cellspacing="0" width="100%" class="formtable">
        <tbody>
        <tr>
            <td>选择关闭理由</td>
            <td>
                <select title="" class="select" name="template_id" id="templateId">
                    <option value="">请选择关闭理由</option>
                    {loop $notice_template_list $template}
                    <option value="{$template[template_id]}">{$template[template_title]}</option>
                    {/loop}
                </select>
            </td>
        </tr>
        <tr>
            <td>其他理由</td>
            <td><textarea title="" class="textarea" name="closeReason" id="closeReason" style="width: 400px; height: 160px;"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="button" class="button" id="submitButton">确认关闭</button></td>
        </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    $("#submitButton").on('click', function () {
        var templateId = $("#templateId").val();
        var closeReason = $.trim($("#closeReason").val());
        if (!templateId && !closeReason){
            alert('请选择关闭原因');
        }else {
            $("#closeForm").ajaxSubmit({
                dataType:'json',
                success:function (response) {
                    if (window.parent.afterCloseShop){
                        window.parent.afterCloseShop(response);
                    }
                }
            });
        }
    });
</script>
</body>
</html>
