<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<?=Html::cssFile('@web/static/dangjian/css/main.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/form.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<?=Html::cssFile('@web/static/dangjian/css/layer.css?v='.date("ymd"), ['rel' => "stylesheet"])?>
<style>
    .layui-form-label {
        width: 100px;
        padding: 10px 15px 7px;
    }
    .layui-input-block {
        margin-left: 130px;
    }
    .require-text {
        color:#DC524B;
    }
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <div style="margin-bottom:0px;">
            <div class="admin-main layui-form layui-field-box">
                <!-- layui-btn-sm -->
                <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>添加人物</legend>
                </fieldset>

                <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                    <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">

                    <div class="layui-form-item layui-upload">
                        <label class="layui-form-label"><span class="require-text">*</span>人物头像</label>
                        <div class="layui-upload layui-input-block">
                            <input type="hidden" name="avatar_img" lay-verify="avatar_img" value="<?=isset($dataInfo['avatar_img']) ? $dataInfo['avatar_img']:"";?>" required lay-verify="required" />
                            <button type="button" class="layui-btn layui-btn-primary" id="fileBtn"><i class="layui-icon">&#xe67c;</i>选择文件</button>
                            <button type="button" class="layui-btn layui-btn-warm" id="uploadBtn">开始上传</button>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>人物姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="full_name" lay-verify="full_name" autocomplete="off" placeholder="请输入人物姓名至少2个字符" class="layui-input" value="<?=isset($dataInfo['full_name']) ? $dataInfo['full_name']:"";?>">
                        </div>
                        <div class="layui-form-mid layui-word-aux">在所在党史人物上显示的党员姓名</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>生世周期
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" name="lifedate" lay-verify="lifedate" id="lifedate" autocomplete="off" placeholder="请选择人物生世周期" class="layui-input" value="<?=(isset($dataInfo['life_start_date'])&&!empty($dataInfo['life_start_date'])) ? $dataInfo['life_start_date']." - ":"";?><?=(isset($dataInfo['life_end_date'])&&!empty($dataInfo['life_end_date'])) ? $dataInfo['life_end_date']:"";?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>是否发布
                        </label>
                        <div class="layui-input-inline">
                            <input type="radio" name="status" value="1" title="是" <?=(isset($dataInfo['status'])&&$dataInfo['status']) ? "checked='checked'":"";?>>
                            <input type="radio" name="status" value="0" title="否" <?=(isset($dataInfo['status'])&&intval($dataInfo['status'])==0) ? "checked='checked'":"";?>>
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>排序</label>
                        <div class="layui-input-inline">
                            <input type="number" name="sort" placeholder="" class="layui-input" lay-verify="number" value="<?=isset($dataInfo['sort']) ? $dataInfo['sort']:0;?>">
                        </div>
                    </div>

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>描述内容</label>
                        </label>
                        <div class="layui-input-label">
                            <textarea placeholder="请输入描述内容" class="layui-textarea" name="content" lay-verify="content" id="layeditContent"><?=isset($dataInfo['content']) ? $dataInfo['content']:"";?></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>简介</label>
                        </label>
                        <div class="layui-input-label">
                            <textarea placeholder="请输入简介内容" class="layui-textarea" name="introduction" lay-verify="introduction" id="layeditIntroduction"><?=isset($dataInfo['introduction']) ? $dataInfo['introduction']:"";?></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="submitLevel">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?=Html::jsFile('@web/static/dangjian/js/delelement.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'layer', 'upload','laydate'], function(){
    var layedit = layui.layedit;
    var table = layui.table
        ,form = layui.form
        ,upload = layui.upload
        ,jq = layui.jquery
        ,$ = layui.jquery;
    var laydate = layui.laydate;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //常规用法
    laydate.render({
        elem: '#lifedate'
        ,range: true
        ,min: '1800-01-01 00:00:00' //最小日期
        ,max: '2099-12-31 23:59:59' //最大日期
    });
    //图片上传
    layui.use('upload',function(){
        upload.render({
            elem: '#fileBtn'
            ,url: '/common/upload/ali-file'
            ,accept: 'image'
            ,acceptMime: 'image/*'
            ,exts: 'jpg|png|gif|bmp|jpeg'
            ,size: 1024 * 10
            ,auto: false
            ,bindAction: '#uploadBtn'
            ,choose: function(obj) {
                obj.preview(function(index, file, result) {
                    var img = new Image();
                    img.onload = function() {
                        if ((img.width/img.height) > 1.7) {
                            layer.msg('图片尺寸【长/高】比例不能大于1.7');
                        }
                    };
                    img.src = result;
                });
            },
            before: function(obj) {
                layer.load();
            }
            ,done: function(res){
                layer.closeAll('loading');
                $("[name=avatar_img]").val(res.data.src);
            }
        });
    });
    //自定义验证规则
    form.verify({
        full_name: function(value){
            if(value.length < 2){
                return '人物姓名至少2个字符！';
            }
        },
        avatar_img: function(value){
            if(value.length < 0){
                return '党史人物头像未上传！';
            }
        },
        content: function(value){
            if(value.length < 0){
                return '描述内容不能为空！';
            }
        },
        introduction: function(value){
            if(value.length < 0){
                return '简介不能为空！';
            }
        },
        lifedate: function(value){
            if(value==" - " || value.length < 0){
                return '请选择人物生世周期！';
            }
        }
    });
    //创建一个编辑器
    var index1 = layedit.build('layeditContent',{
        height: 180, //设置编辑器高度
        width: 300, //设置编辑器高度
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
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    }); //建立编辑器
    //创建一个编辑器
    var index2 = layedit.build('layeditIntroduction',{
        height: 180, //设置编辑器高度
        width: 300, //设置编辑器高度
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
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    }); //建立编辑器
    //监听提交
    form.on('submit(submitLevel)', function(data){
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/leaders/edit']); ?>",
            contentType: "application/json;charset=utf-8",
            data: JSON.stringify(data.field),
            dataType: "json",
            beforeSend: function (XMLHttpRequest) {
                for (var i in headerParams) {
                    XMLHttpRequest.setRequestHeader(i, headerParams[i]);
                }
            },
            success: function (result) {
                if (result.code == 0) {
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6
                    },function(){
                        window.history.go(-1);
                    });
                    return true;
                } else if(result.code == 5001){
                    layer.msg(result.msg, {
                        icon: 2,
                        shade: 0.6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        top.location.href="../user/login"
                    });
                    return true;
                } else {
                    layer.msg(result.msg, {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return true;
                }
            },
            error: function () {
                layer.msg("系统异常", {
                    time: 2000,
                    shade: 0.6,
                    icon: 2
                });
                return true;
            }
        })
        return false;
    });

    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>