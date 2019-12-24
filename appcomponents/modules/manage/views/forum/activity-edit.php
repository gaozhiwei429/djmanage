<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
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
    .layui-form-item .layui-input-inline {
        width: 195px;
    }
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <div style="margin-bottom:0px;">
            <div class="admin-main layui-form layui-field-box">
                <!-- layui-btn-sm -->
                <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>编辑主题活动</legend>
                </fieldset>

                <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                    <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">

                    <div class="layui-form-item layui-upload">
                        <label class="layui-form-label">活动封面图</label>
                        <div class="layui-upload layui-input-block">
                            <input type="hidden" name="pic_url" value="<?=isset($info['pic_url']) ? $info['pic_url']:"";?>" required lay-verify="required" />
                            <button type="button" class="layui-btn layui-btn-primary" id="fileBtn"><i class="layui-icon">&#xe67c;</i>选择文件</button>
                            <button type="button" class="layui-btn layui-btn-warm" id="uploadBtn">开始上传</button>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>活动名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" lay-verify="title" placeholder="请输入活动名称至少2个字符" class="layui-input" value=<?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux">在所在党组织上显示的活动名称</div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>是否上线
                        </label>
                        <div class="layui-input-inline">
                            <input type="radio" name="status" value="1" title="是" <?=(isset($dataInfo['status'])&&$dataInfo['status']) ? "checked='checked'":"checked='checked'";?>>
                            <input type="radio" name="status" value="0" title="否" <?=(isset($dataInfo['status'])&&$dataInfo['status']==0) ? "checked='checked'":"";?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text"></span>时间
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" name="startandenddate" id="startandenddate" autocomplete="off" placeholder="请选择活动周期" class="layui-input" value="<?=(isset($dataInfo['start_time'])&&!empty($dataInfo['start_time'])) ? $dataInfo['start_time']." - ":"";?><?=(isset($dataInfo['end_time'])&&!empty($dataInfo['end_time'])) ? $dataInfo['end_time']:"";?>">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>地点</label>
                        <div class="layui-input-inline">
                            <input type="text" name="address" lay-verify="address" placeholder="请输入活动地点至少2个字符" class="layui-input" value=<?=isset($dataInfo['address']) ? $dataInfo['address']:"";?>>
                        </div>
                        <div class="layui-form-mid layui-word-aux">主题活动上显示的地点</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>所属党组织
                        </label>
                        <div class="layui-input-inline">
                            <select name="organization_id" lay-verify="required" lay-search="">
                                <option value="" <?=(isset($dataInfo['organization_id']) && $dataInfo['organization_id']==0) ? "selected":"";?>>栏目选择</option>
                                <?php
                                if(isset($treeData) && !empty($treeData)) {
                                    foreach($treeData as $treeInfo) {
                                        ?>
                                        <option value="<?=isset($treeInfo['id']) ? $treeInfo['id'] : 0;?>" <?=(isset($dataInfo['organization_id']) && $treeInfo['id']==$dataInfo['organization_id']) ? "selected" : "";?>><?=isset($treeInfo['title']) ? $treeInfo['title'] : "";?></option>';
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">活动内容</label>
                        <div class="layui-input-block">
                            <textarea id="layeditProblem" name="content"><?=isset($dataInfo['content']) ? $dataInfo['content']:"";?></textarea>
                            <div class="layui-form-mid layui-word-aux">主题活动上显示的活动内容</div>
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
<script type="application/javascript">
    layui.use(['form', 'table', 'laypage', 'upload','layedit','laydate'], function(){
        var layedit2 = layui.layedit;
        var table = layui.table
            ,form = layui.form
            ,laydate = layui.laydate
            ,jq = layui.jquery
            ,$ = layui.jquery;
        var upload = layui.upload;
        var storage=window.localStorage;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);

        //图片上传
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
                $("[name=pic_url]").val(res.data.src);
            }
        });
        //常规用法
        laydate.render({
            elem: '#startandenddate'
            ,range: true
            ,min: '2019-01-01 00:00:00' //最小日期
            ,max: '2099-12-31 23:59:59' //最大日期
            ,type: "datetime"
        });
        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 2){
                    return '活动名称至少2个字符！';
                }
            }
        });
        layedit2.set({
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
        var index2 = layedit2.build('layeditProblem',{
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
        });
        //监听提交
        form.on('submit(submitLevel)', function(data){
            data.field.content = layedit2.getContent(index2);
            $.ajax({
                type: "post",
                url: "<?= Url::to(['common/activity/edit']); ?>",
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
                        return false;
                    } else if(result.code == 5001){
                        layer.msg(result.msg, {
                            icon: 2,
                            shade: 0.6,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            top.location.href="../user/login"
                        });
                        return false;
                    } else {
                        layer.msg(result.msg, {
                            time: 2000,
                            shade: 0.6,
                            icon: 2
                        });
                        return false;
                    }
                },
                error: function () {
                    layer.msg("系统异常", {
                        time: 2000,
                        shade: 0.6,
                        icon: 2
                    });
                    return false;
                }
            });
            return false;
        });
        form.render(); //更新全部，防止input多选和单选框不显示问题
    });
</script>