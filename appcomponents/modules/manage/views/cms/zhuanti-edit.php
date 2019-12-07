<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<?=Html::jsFile('@web/static/plugs/ace/ace.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<style>
    select.block{
        display:none!important;
    }
</style>
<style type="text/css">
    .uploader-list {
        margin-left: -15px;
    }
    .uploader-list .info {
        position: relative;
        margin-top: -25px;
        background-color: black;
        color: white;
        filter: alpha(Opacity=80);
        -moz-opacity: 0.5;
        opacity: 0.5;
        width: 100px;
        height: 25px;
        text-align: center;
        display: none;
    }
    .uploader-list .handle {
        position: relative;
        background-color: black;
        color: white;
        filter: alpha(Opacity=80);
        -moz-opacity: 0.5;
        opacity: 0.5;
        width: 100px;
        text-align: right;
        height: 18px;
        margin-bottom: -18px;
        display: none;
    }
    .uploader-list .handle span {
        margin-right: 5px;
    }
    .uploader-list .handle span:hover {
        cursor: pointer;
    }
    .uploader-list .file-iteme {
        margin: 12px 0 0 15px;
        padding: 1px;
        float: left;
    }
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <?php
                    if(isset($info) && !empty($info)) {
                    ?>
                    <input name="title" value='<?=isset($info['title']) ? $info['title']:"";?>' required="required" pattern="^.{3,50}$" title="请输入正确的标题名称" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    } else{
                    ?>
                    <input name="title" value='' required="required" pattern="^.{3,50}$" title="请输入正确的标题名称" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="layui-form-item layui-upload">
                <label class="layui-form-label">文章图片</label>
                    <button type="button" class="layui-btn layui-btn-primary" id="projectBannerImg">多图片上传</button>
                <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;width: 88%">
                        预览图：
                   <div class="layui-upload-list uploader-list" style="overflow: auto;" id="uploader-list" style="height: 100px;">
                        <?php
                        if(isset($info['pic_url']) && is_array($info['pic_url'])) {
                            foreach($info['pic_url'] as $picUrl) {
                                ?>
                                <div id="" class="file-iteme">
                                    <div class="handle" style="display: none;"><span class="glyphicon glyphicon-trash"></span></div>
                                    <input value="<?=(isset($picUrl)&&!is_array($picUrl)) ? $picUrl:"";?>" name="pic_url[]" class="layui-upload-img" style="display:none;">
                                    <img style="width: 100px;height: 100px;" src="<?=(isset($picUrl)&&!is_array($picUrl)) ? $picUrl:"";?>">
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </blockquote>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">内容</label>
                <div class="layui-input-block">
                    <textarea id="layeditDemo"><?=isset($info['content']) ? $info['content']:"";?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否上线</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="是" <?=(isset($info['status']) && $info['status']==1) ? "checked" : "";?>>
                    <input type="radio" name="status" value="0" title="否" <?=(isset($info['status']) && $info['status']==0) ? "checked" : "";?>>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">选择类型</label>
                <div class="layui-input-inline">
                    <div class="layui-form-select downpanel">
                        <div class="layui-unselect layui-select-title">
<select name="zhuanti_type_id">
<option value="0" <?=(isset($info['zhuanti_type_id']) && $info['zhuanti_type_id']==0) ? "selected" : "";?>>请选择</option>
<?php
if(isset($zhuantiTypeData)) {
foreach($zhuantiTypeData as $typeInfo) {
    ?>
    <option value="<?=isset($typeInfo['id']) ? $typeInfo['id'] : 0;?>" class="<?=(isset($typeInfo['id']) && isset($info['zhuanti_type_id']) && $typeInfo['id']==$info['zhuanti_type_id']) ? "layui-this" : "";?>"><?=isset($typeInfo['title']) ? $typeInfo['title'] : "";?></option>
<?php
}
}
?>
</select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="layui-form-item text-center">
                <?php
                if(isset($info['id'])){
                ?>
                <input type='hidden' value='<?=isset($info['id']) ? $info['id']:0;?>' name='id'>
                <?php
                }
                ?>
                <button lay-submit="" lay-filter="commit" class="layui-btn"'>保存数据</button>
                <button class="layui-btn layui-btn-danger" type='button' data-close>取消编辑</button>
            </div>
        </form>
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'upload','layedit'], function(){
    var form = layui.form;
    var layedit = layui.layedit;
    var $ = layui.jquery
        ,upload = layui.upload;

    $(".downpanel").on("click", ".layui-select-title", function (e) {
        $(".layui-form-select").not($(this).parents(".layui-form-select")).removeClass("layui-form-selected");
        $(this).parents(".downpanel").toggleClass("layui-form-selected");
        layui.stope(e);
    }).on("click", "dl i", function (e) {
        layui.stope(e);
    });
    $(document).on("click", function (e) {
        $(".layui-form-select").removeClass("layui-form-selected");
    });
    upload.render({
        elem: '#projectBannerImg'
        ,url: '/common/upload/ali-file'
        ,multiple: true
        ,accept: 'image'
        ,acceptMime: 'image/*'
        ,exts: 'jpg|png|gif|bmp|jpeg'
        ,size: 1024 * 10
        ,before: function(obj){
            layer.msg('图片上传中...', {
                icon: 16,
                shade: 0.01,
                time: 0
            })
        }
        ,done: function(res){
            layer.close(layer.msg());//关闭上传提示窗口
            //上传完毕
            $('#uploader-list').append(
                '<div id="" class="file-iteme">' +
                '<div class="handle"><span class="glyphicon glyphicon-trash"></span></div>' +
                '<input value="'+ res.data.src +'" name="pic_url[]" class="layui-upload-img" style="display:none;">' +
                '<img style="width: 100px;height: 100px;" src='+ res.data.src +'>' +
                '<div class="info">' + res.data.title + '</div>' +
                '</div>'
            );
        }
    });
    $(document).on("mouseenter mouseleave", ".file-iteme", function(event){
        if(event.type === "mouseenter"){
            //鼠标悬浮
            $(this).children(".info").fadeIn("fast");
            $(this).children(".handle").fadeIn("fast");
        }else if(event.type === "mouseleave") {
            //鼠标离开
            $(this).children(".info").hide();
            $(this).children(".handle").hide();
        }
    });
    // 删除图片
    $(document).on("click", ".file-iteme .handle", function(event){
        $(this).parent().remove();
    });
    layedit.set({
        uploadImage: {
            url: '/common/upload/ali-file',
            accept: 'image',
            acceptMime: 'image/*',
            exts: 'jpg|png|gif|bmp|jpeg',
            size: 1024 * 10,
            done:function (data) {
                console.log(data);
            }
        }
        , height: '90%'
    });
    var index = layedit.build('layeditDemo',{
        height: 180, //设置编辑器高度
        tool: [
            'html',
            'code',
            'strong' //加粗
            ,'italic' //斜体
            ,'underline' //下划线
            ,'del' //删除线
            ,'addhr'
            ,'|' //分割线
            ,'left' //左对齐
            ,'center' //居中对齐
            ,'right' //右对齐
            ,'link' //超链接
            ,'unlink' //清除链接
            ,'face' //表情
            ,'image' //插入图片
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    }); //建立编辑器
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    form.on('submit(commit)', function(data){
        data.field.content = ""; //获取html
        var content = layedit.getContent(index);
        if(content) {
            data.field.content =content;
        }
        $.ajax({
            type: "post",
            url:"<?= Url::to(['/common/zhuanti/edit']); ?>",
            contentType: "application/json;charset=utf-8",
            data :JSON.stringify(data.field),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for(var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success:function(result){
                if(result.code == 0) {
                    layer.alert('提交成功', {icon: 1,
                        time: 2000}, function(index){
                        window.history.back();
                    });
                    return false;
                } else if(result.code == 5001) {
                    layer.alert('登录状态异常', {icon: 2}, function(index){
                    });
                    layer.closeAll();
                    top.location.href="../user/login";
                    return false;
                } else {
                    layer.alert(result.msg, {icon: 2});
                    return false;
                }
            },
            error: function () {
                layer.alert('网络环境异常请检查', {icon: 2});
                return false;
            }
        });
        return false;
    });
    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>