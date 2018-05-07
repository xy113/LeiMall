;$(function () {
    //全选，新版本
    $("[data-action=checkall]").on('click', function () {
        var target = $(this).attr('data-target');
        if(typeof(target) === 'undefined'){
            target = 'input.checkmark';
        }
        $(target).prop('checked', $(this).is(":checked"));
    });
    //懒加载
    $(".lazyload").lazyload({
        effect:'fadeIn',
        placeholder:'/images/common/placeholder.png'
    });
    //异步加载图片
    $(".asyncload").each(function () {
        var self = this;
        var imgurl = $(this).attr('data-original');
        if (this.tagName.toLowerCase() === 'img'){
            $(this).attr("src", "/images/common/placeholder.png");
            $("<img/>").attr("src", imgurl).load(function () {
                $(self).attr('src', imgurl);
            });
        }else {
            $("<img/>").attr("src", imgurl).load(function () {
                $(self).css('background-image','url('+imgurl+')');
            });
        }
    });
    $(".sortable").sortable();
    $("[data-action=refresh]").on('click', function () {
        DSXUtil.reFresh();
    });
});
