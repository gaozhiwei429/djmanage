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
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <?php
                    if(isset($info) && !empty($info)) {
                        ?>
                        <input name="title" value='<?=isset($info['title']) ? $info['title']:"";?>' required="required" pattern="^.{3,50}$" title="请输入正确的标题" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    } else{
                        ?>
                        <input name="title" value='' required="required" pattern="^.{3,50}$" title="请输入正确的标题" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">长标题</label>
                <div class="layui-input-block">
                    <?php
                    if(isset($info) && !empty($info)) {
                    ?>
                        <input name="subtitle" value='<?=isset($info['subtitle']) ? $info['subtitle']:"";?>' required="required" pattern="^.{3,50}$" title="请输入正确的标题" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    } else{
                        ?>
                        <input name="subtitle" value='' required="required" pattern="^.{3,50}$" title="请输入正确的标题" placeholder="请输入3位及以上字符" class="layui-input">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="layui-form-item layui-upload">
                <label class="layui-form-label">封面图</label>
                <div class="layui-upload layui-input-block">
                    <input type="hidden" name="cover_img" value="<?=isset($info['cover_img']) ? $info['cover_img']:"";?>" required lay-verify="required" />
                    <button type="button" class="layui-btn layui-btn-primary" id="fileBtn"><i class="layui-icon">&#xe67c;</i>选择文件</button>
                    <button type="button" class="layui-btn layui-btn-warm" id="uploadBtn">开始上传</button>
                </div>
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
                <label class="layui-form-label">所属分类</label>
                <div class="layui-input-block">
<select name="technical_support_type_id" lay-filter="technical_support_type_id">
<?php
if(isset($technicalSupportTypeList) && !empty($technicalSupportTypeList)) {
    foreach($technicalSupportTypeList as $k=>$technicalSupportTypeInfo) {
?>
<option value="<?=isset($technicalSupportTypeInfo['id']) ? $technicalSupportTypeInfo['id'] : 0;?>"
<?=(isset($info['technical_support_type_id']) && $info['technical_support_type_id']==$technicalSupportTypeInfo['id']) ? "selected" : "";?>>
<?=isset($technicalSupportTypeInfo['name']) ? $technicalSupportTypeInfo['name'] : "";?>
</option>
<?php
    }
}
?>
</select>
                </div>
            </div>
            <div class="layui-form-item layui-upload" id="fileUrlFile"  style="display: none">
                <label class="layui-form-label">说明书文件</label>
                <div class="layui-upload layui-input-block">
                    <input type="hidden" name="file_url" value="<?=isset($info['file_url']) ? $info['file_url']:"";?>"/>
                    <button type="button" class="layui-btn layui-btn-primary" id="fileUrlBtn"><i class="layui-icon">&#xe67c;</i>选择说明书文件</button>
                    <button type="button" class="layui-btn layui-btn-warm" id="uploadFileUrlBtn">开始上传说明书</button>
                </div>
            </div>

            <div class="layui-form-item layui-upload" id="videoUrlFile" style="display: none">
                <label class="layui-form-label">视频文件</label>
                <div class="layui-upload layui-input-block">
                    <input type="hidden" name="video_url" value="<?=isset($info['video_url']) ? $info['video_url']:"";?>"/>
                    <button type="button" class="layui-btn layui-btn-primary" id="videoUrlBtn"><i class="layui-icon">&#xe67c;</i>选择视频文件</button>
                    <button type="button" class="layui-btn layui-btn-warm" id="uploadVideoUrlBtn">开始上传视频文件</button>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="layui-form-item text-center">
                <input type="hidden" value="<?=isset($info['id']) ? $info['id'] : 0;?>" name="id">
                <button lay-submit="" lay-filter="commit" class="layui-btn"'>保存数据</button>
                <button class="layui-btn layui-btn-danger" type='button' data-close>取消编辑</button>
            </div>
        </form>
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'upload','layedit', 'tree'], function(){
    var form = layui.form;
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
        var layedit = layui.layedit;
        var $ = layui.jquery
            ,upload = layui.upload;
    form.on('select(technical_support_type_id)', function(data){
        var val=data.value;
        if(val == 3){
            $("#fileUrlFile").show();
            $("#videoUrlFile").hide();
        }else if(val == 4) {
            $("#videoUrlFile").show();
            $("#fileUrlFile").hide();
        } else {
            $("#fileUrlFile").hide();
            $("#videoUrlFile").hide();
        }
    });
    //监听提交
    var params = {};
    var selfUrl = window.location.href;

        //图片上传
        layui.use('upload',function(){
            var upload = layui.upload;
            upload.render({
                elem: '#fileBtn'
                ,url: '/common/upload/ali-file'
                ,accept: 'image'
                ,acceptMime: 'image/*'
                ,exts: 'jpg|png|gif|bmp|jpeg'
                ,size: 1024 * 10
                ,auto: false
                ,bindAction: '#uploadBtn'
                ,done: function(res){
                    $("[name=cover_img]").val(res.data.src);
                }
            });
            //说明书文件
            upload.render({
                elem: '#fileUrlBtn'
                ,url: '/common/upload/ali-file'
                ,accept: 'file'
//            ,acceptMime: 'test/xml'
                ,exts: 'pdf|doc'
                ,size: 1024000 * 1000000
                ,auto: false
                ,bindAction: '#uploadFileUrlBtn'
                ,done: function(res){
                    $("[name=file_url]").val(res.data.src);
                }
            });
            //视频文件
            upload.render({
                elem: '#videoUrlBtn'
                ,url: '/common/upload/ali-file'
                ,accept: 'file'
//            ,acceptMime: 'test/xml'
                ,exts: 'mp4'
                ,size: 1024000 * 1000000
                ,auto: false
                ,bindAction: '#uploadVideoUrlBtn'
                ,done: function(res){
                    $("[name=video_url]").val(res.data.src);
                }
            });
        });

        layedit.set({
            uploadImage: {
                url: '/common/upload/ali-file',
                accept: 'image',
                acceptMime: 'image/*',
                exts: 'jpg|png|gif|bmp|jpeg|pdf|mp4',
                size: 1024000 * 1000000,
                done:function (data) {
                    console.log(data);
                }
            }
            , height: '90%'
        });
        //,{tool: ['strong', 'italic','underline','del','|','left','center','right','|','link','unlink','face','image','|','code']}
//    layedit.build('layeditDemo'); //建立编辑器
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
        form.on('submit(commit)', function(data){
            data.field.content = ""; //获取html
            var describe = layedit.getContent(index);
            if(describe) {
                data.field.content =describe;
            }
            $.ajax({
                type: "post",
                url:"<?= Url::to(['/common/technical-support/edit']); ?>",
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
                        layer.alert('提交成功', {icon: 1}, function(index){
                            parent.location.reload();
                            layer.closeAll();
                        });
                    } else if(result.code == 5001) {
                        layer.alert('登录状态异常', {icon: 2}, function(index){
                            top.location.href="../user/login";
                        });
                    } else {
                        layer.alert(result.msg, {icon: 2}, function(index){
                            parent.location.reload();
                            layer.closeAll();
                        });
                    }
                },
                error: function () {
                    layer.alert('网络环境异常请检查', {icon: 2});
                }
            });
        });
        form.render(); //更新全部，防止input多选和单选框不显示问题
    });
</script>