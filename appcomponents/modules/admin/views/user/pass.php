<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = '智慧党建管理系统 北京往全保科技有限公司';
?>
<div class="layui-card-body">
    <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" method="get">
        <!--{if $verify}-->
        <!--    <div class="layui-form-item">-->
        <!--        <label class="layui-form-label">旧的密码</label>-->
        <!--        <div class="layui-input-block">-->
        <!--            <input autofocus name="oldpassword" value='' pattern="^\S{1,}$" required="" title="请输入旧的密码" placeholder="请输入旧的密码" class="layui-input">-->
        <!--        </div>-->
        <!--    </div>-->
        <!--{/if}-->

        <div class="layui-form-item">
            <label class="layui-form-label">新的密码</label>
            <div class="layui-input-block">
                <input name="onepassword" value='' pattern="^\S{1,}$" required="" title="请输入新的密码" placeholder="请输入新的密码" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">重复密码</label>
            <div class="layui-input-block">
                <input name="twopassword" value='' pattern="^\S{1,}$" required="" title="请输入重复密码" placeholder="请输入重复密码" class="layui-input">
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="layui-form-item text-center">
            <input type='hidden' value='<?=$id;?>' name='user_id'>
            <button class="layui-btn layui-btn-primary" lay-submit="" lay-filter="commit">保存数据</button>
            <!--        <button class="layui-btn" type='submit'>保存数据</button>-->
            <button class="layui-btn layui-btn-danger" type='button' data-confirm="" data-close>取消编辑</button>
        </div>
    </form>
</div>
<script type="application/javascript">
    layui.use(['form', 'table', 'laypage', 'layer'], function(){
        var laypage = layui.laypage
            ,form = layui.form;
        var storage=window.localStorage;
        var table = layui.table;
        var userData = storage.getItem("userData");
        var headerParams = JSON.parse(userData);
        //监听提交
        var params = {};
        form.on('submit(commit)', function(data){
//            $.each(data.field, function(i, item){
//                params.i=item;
//            });
            $.ajax({
                type: "post",
                url:"<?= Url::to(['passport/user/reset-pwd']); ?>",
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
                        layer.alert('修改成功', {icon: 1}, function(index){
                            parent.location.reload();
                        });
                    } else {
                        layer.alert(result.msg, {icon: 2});
                    }
                },
                error: function () {
                    layer.msg('请求数据异常', {icon: 5});
                }
            });
        });
    });
</script>