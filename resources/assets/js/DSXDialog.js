function DSXDialog(settings){
    var option = $.extend({
        title:'标题',
        confirmText:'确定',
        cancelText:'取消',
        content:'在这里输入内容',
        fixed:true,
        dragable:true,
        showHeader : true,
        showFooter : true,
        style:{
            width:'600px'
        },
        top:'15%'
    },settings);

    var self = this;
    var _window = window;
    var _document = window.document;
    var dialogCount = DSXDialog.__count;
    var header = '<div class="dialog-header">' +
                    '<h4 class="dialog-title">'+option.title+'</h4>' +
                    '<a class="close">&times;</a>' +
                 '</div>';
    var footer = '<div class="dialog-footer">' +
                    '<button type="button" class="btn btn-default oncancel" tabindex="1">'+option.cancelText+'</button>' +
                    '<button type="button" class="btn btn-primary onconfirm" tabindex="1">'+option.confirmText+'</button>' +
                 '</div>';
    var content = $('<div class="dialog-content">'+option.content+'</div>');
    var dialog  = $("<div/>").addClass('dialog').css(option.style);

    if (option.showHeader) dialog.append(header);
    dialog.append(content);
    if (option.showFooter) dialog.append(footer);

    this.id = option.id ? option.id : 'dsxui-modal-'+dialogCount;
    this.zIndex = option.zIndex ? option.zIndex : dialogCount+1000;

    var modal = $('<div id="'+this.id+'" class="dsxui-modal"></div>').css({'z-index':this.zIndex+1}).append(dialog);
    var overLayer = $('<div id="dsxui-overlayer-'+dialogCount+'" class="dsxui-overlayer"></div>').css({'z-index':this.zIndex});


    this.setPosition = function(){
        var left = ($(_window).width() - modal.outerWidth()) / 2;
        var top = ($(_window).height() - modal.outerHeight()) / 2;
        modal.css({top:option.top,left:left});
    };

    this.close = function(){
        if (option.willClose) option.willClose(self);
        modal.remove();
        overLayer.remove();
        if(option.afterClose) option.afterClose(self);
    };

    var init = function(){
        overLayer.appendTo(_document.body).show();
        modal.appendTo(_document.body).show();
        self.setPosition();
        if (option.dragable) {
            var mouse={x:0,y:0};
            function moveDialog(event){
                var e = window.event || event;
                var top = parseInt(modal.css('top')) + (e.clientY - mouse.y);
                var left = parseInt(modal.css('left')) + (e.clientX - mouse.x);
                modal.css({top:top,left:left});
                mouse.x = e.clientX;
                mouse.y = e.clientY;
            };
            modal.find('.dialog-header').mousedown(function(event){
                var e = window.event || event;
                mouse.x = e.clientX;
                mouse.y = e.clientY;
                $(_document).bind('mousemove',moveDialog);
                $(this).css('cursor','move');
            });
            $(_document).on('mouseup', function(event){
                $(_document).off('mousemove', moveDialog);
                modal.find('.dialog-header').css('cursor','default');
            });
        }

        /* 绑定一些相关事件。 */
        modal.find('.close').on('click', self.close);
        modal.find('.onconfirm').on('click', function(e){
            if(option.onConfirm) option.onConfirm(self);
        });
        modal.find('.oncancel').on('click', function(e){
            if(option.onCancel) option.onCancel(self);
            self.close();
        });
        if(option.afterShow) option.afterShow(self);
    };
    init.call(this);
    DSXDialog.__count++;
}
DSXDialog.__count = 1;
