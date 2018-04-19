<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>图片选择器</title>
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/image_plugin.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
</head>
<body>
<!--<div class="side-bar">-->

<!--</div>-->
<div class="main-frame">
    <div class="title">
        <div class="upload-button" id="picker">选择图片</div>
    </div>
    <div class="content">
        <div class="image-list">
            <ul>
                @foreach($imagelist as $img)
                <li>
                    <div class="con" rel="item" data-id="{{$img['id']}}" data-image="{{$img['image']}}" data-thumb="{{$img['thumb']}}" data-image-url="{{$img['imageurl']}}" data-thumb-url="{{$img['thumburl']}}">
                        <div class="img bg-cover" style="background-image: url({{$img['thumburl']}})"></div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="action-bar">
            <div style="text-align: center;">{!! $pagination !!}</div>
        </div>
    </div>
</div>
<div class="spinner">
    <div class="modal"></div>
    <span class="animation"></span>
</div>
<link href="{{asset('webuploader/webuploader.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('webuploader/webuploader.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // 初始化Web Uploader
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,
        // swf文件路径
        swf: '{{asset('webuploder/Uploader.swf')}}',
        // 文件接收服务端。
        server: "{{url('/service/upload/image')}}",
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#picker',
        // 只允许选择图片文件。
        multiple:false,
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,png',
            mimeTypes: 'image/*'
        },
        fileVal:"file",
        formData:{'_token':'{{csrf_token()}}'}
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadStart', function( file, percentage ) {
        DSXUI.showSpinner();
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file , response) {
        setTimeout(function () {
            DSXUI.hideSpinner();
            if (window.parent.onPickedImage){
                window.parent.onPickedImage(response.image);
            }
        }, 500);
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file, reason ) {
        alert(JSON.stringify(reason));
    });


    $("[rel=item]").on('click', function () {
        var id = $(this).attr('data-id');
        var image = $(this).attr('data-image');
        var thumb = $(this).attr('data-thumb');
        var imageurl = $(this).attr('data-image-url');
        var thumburl = $(this).attr('data-thumb-url');
        if (window.parent.onPickedImage){
            window.parent.onPickedImage({
                "id":id,
                "image":image,
                "thumb":thumb,
                "imageurl":imageurl,
                "thumburl":thumburl
            });
        }
    });
</script>
</body>
</html>
