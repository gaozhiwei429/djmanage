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
                    <legend>添加职务</legend>
                </fieldset>

                <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                    <input type="hidden" name="id" class="layui-input" value="<?=isset($dataInfo['id']) ? $dataInfo['id']:"";?>">
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>职务名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入职务名称至少2个字符" class="layui-input" value="<?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>">
                        </div>
                        <div class="layui-form-mid layui-word-aux">在所在党组织上显示的职务名称</div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>是否上线
                        </label>
                        <div class="layui-input-inline">
                            <input type="radio" name="status" value="1" title="是" <?=(isset($dataInfo['status'])&&$dataInfo['status']) ? "checked='checked'":"";?>>
                            <input type="radio" name="status" value="0" title="否" <?=(isset($dataInfo['status'])&&$dataInfo['status']==0) ? "checked='checked'":"";?>>
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>排序</label>
                        <div class="layui-input-inline">
                            <input type="number" name="sort" placeholder="" class="layui-input" lay-verify="number" value="<?=isset($dataInfo['sort']) ? $dataInfo['sort']:0;?>">
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
layui.use(['form', 'table', 'laypage'], function(){
    var layedit = layui.layedit;
    var table = layui.table
        ,form = layui.form
        ,jq = layui.jquery
        ,$ = layui.jquery;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);

    //自定义验证规则
    form.verify({
        title: function(value){
            if(value.length < 2){
                return '职务名称至少2个字符！';
            }
        }
    });
    //监听提交
    form.on('submit(submitLevel)', function(data){
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/level/edit']); ?>",
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