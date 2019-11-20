<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<div class="layui-card">
    <div class="layui-card-body">
        <form class="layui-form" action="">
            <input type="hidden" name="course_uuid" value="<?=isset($course_uuid) ? $course_uuid:"";?>" class="layui-input">
            <div class="layui-form-item">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" value="<?=isset($info['title']) ? $info['title']:"";?>" lay-verify="title" autocomplete="off" placeholder="请输入章节名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort" value="<?=isset($info['sort']) ? $info['sort']:"";?>" lay-verify="required|number" autocomplete="off" placeholder="请输入排序值" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否上线</label>
                <div class="layui-input-inline">
                    <input type="radio" name="status" value="1" title="是" <?=(isset($info['status']) && $info['status']==1) ? "checked" : "";?>>
                    <input type="radio" name="status" value="0" title="否" <?=(isset($info['status']) && $info['status']==0) ? "checked" : "";?>>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    layui.use(['form', 'table', 'laypage', 'layer'], function(){
        var form = layui.form;
        var storage=window.localStorage;
        var $ = layui.jquery
            ,layer = layui.layer;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        //监听提交
        var params = {};
        var selfUrl = window.location.href;
        //监听提交
        form.on('submit(formDemo)', function(data){
            $.ajax({
                type: "post",
                url:"<?= Url::to(['common/sections/edit']); ?>",
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
                        layer.msg(result.msg, {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            parent.location.reload();
                        });
                    } else if(result.code == 5001) {
                        layer.msg(result.msg, {
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            top.location.href="../user/login"
                        });
                    }else {
                        layer.msg(result.msg, {
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        });
                        return false;
                    }
                },
                error: function () {
                    layer.msg("网络异常！", {
                        icon: 1,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    });
                    return false;
                }
            });
            return false;
        });
        form.render(); //更新全部，防止input多选和单选框不显示问题
    });
</script>