<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?=Html::jsFile('@web/static/plugs/ace/ace.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<style>
select.block{
    display:none!important;
}
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
            <input type='hidden' value='<?=isset($info['id']) ? intval($info['id']) : 0;?>' name='id'>
            <div class="layui-form-item">
                <label class="layui-form-label">分组名称</label>
                <div class="layui-input-block">
                    <input name="name" value='<?=isset($info['name']) ? $info['name']:"";?>' required="required" pattern="^.{2,50}$" title="请输入分组名称" placeholder="请输入2位及以上字符分组名称" class="layui-input">
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="layui-form-item text-center">
                <button lay-submit="" lay-filter="commit" class="layui-btn"'>保存数据</button>
                <button class="layui-btn layui-btn-danger" type='button' data-close>取消编辑</button>
            </div>
        </form>
    </div>
</div>

<script type="application/javascript">
layui.use(['form', 'layer'], function(){
    var form = layui.form;
    var layer = layui.layer;
    form.render(); //更新全部，防止input多选和单选框不显示问题
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    var id = "<?=$id;?>";
    form.on('submit(commit)', function(data){
        $.ajax({
            type: "post",
            url:"<?= Url::to(['common/concern-group/edit']); ?>",
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
                        top.location.href=selfUrl;
                    });
                } else if(result.code == 5001) {
                    layer.alert('登录状态异常', {icon: 2}, function(index){
                        top.location.href="../user/login";
                    });
                } else {
                    layer.alert(result.msg, {icon: 2});
                }
            },
            error: function () {
                layer.alert('网络环境异常请检查', {icon: 2}, function(index){
                    layer.close(index);
                });
            }
        });
    });
});
</script>