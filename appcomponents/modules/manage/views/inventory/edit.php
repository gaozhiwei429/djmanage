<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<style>
    select.block{
        display:none!important;
    }
</style>

<div class="layui-card">
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <?php
                    if(isset($userInfo) && !empty($userInfo)) {
                    ?>
                        <input readonly="readonly" disabled="disabled" name="username" value='<?=isset($userInfo['username']) ? $userInfo['username']:"";?>' required="required" title="请输入用户名" placeholder="请输入用户名" class="layui-input layui-bg-gray">
                    <?php
                    } else{
                    ?>
                    <input name="username" value='' required="required" pattern="^.{5,50}$" title="请输入用户名" placeholder="请输入5位及以上字符用户名" class="layui-input">
                    <?php
                    }
                    ?>
                </div>
            </div>

            <?php
            if(!isset($userInfo) || empty($userInfo)) {
            ?>
            <div class="layui-form-item">
                <label class="layui-form-label">用户密码</label>
                <div class="layui-input-block">
                    <input type="password" autofocus name="password" required="required" autocomplete="off" class="layui-input" title="请输入密码" placeholder="请输入密码">
                </div>
            </div>
            <?php
            }
            ?>
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input name="nickname" required="required" pattern="^.{2,8}$" value='<?=isset($userInfo['nickname']) ? $userInfo['nickname']:"";?>' title="请输入姓名" placeholder="请输入2~8位字符长度姓名" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">联系电话</label>
                <div class="layui-input-block">
                    <input type="tel" autofocus name="mobile" required="required" value='<?=isset($userInfo['mobile']) ? $userInfo['mobile']:"";?>' pattern="^1[0-9][0-9]{9}$" title="请输入手机" placeholder="请输入手机" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">联系邮箱</label>
                <div class="layui-input-block">
                    <input type="email" autofocus name="email" required="required" value='<?=isset($userInfo['email']) ? $userInfo['email']:"";?>' pattern="^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$" title="请输入邮箱" placeholder="请输入邮箱" class="layui-input">
                </div>
            </div>
            <?php
            if(isset($roleDataList) && !empty($roleDataList)) {
            ?>
            <div class="layui-form-item">
                <label class="layui-form-label">角色</label>
                <div class="layui-input-block">
                    <?php
                    foreach($roleDataList as $roleData){
                    ?>
                    <?php
                    if(isset($roleData['id']) && in_array($roleData['id'], $roleIds)) {
                    ?>
                        <input type="checkbox" checked name="role_id[]" value="<?=isset($roleData['id']) ? $roleData['id']:0;?>" title="<?=isset($roleData['role_name']) ? $roleData['role_name']:"";?>"> <?=isset($roleData['role_name']) ? $roleData['role_name']:"";?>
                    <?php
                    } else{
                    ?>
                        <input type="checkbox" name="role_id[]" value="<?=isset($roleData['id']) ? $roleData['id']:0;?>" title="<?=isset($roleData['role_name']) ? $roleData['role_name']:"";?>"> <?=isset($roleData['role_name']) ? $roleData['role_name']:"";?>
                    <?php
                    }
                    ?>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($roleDataList)){
                    ?>
                    <span class="color-desc" style="line-height:36px">未配置角色</span>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="hr-line-dashed"></div>

            <div class="layui-form-item text-center">
                <?php
                if(isset($id)){
                ?>
                <input type='hidden' value='<?=isset($id) ? $id:0;?>' name='user_id'>
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
layui.use(['form', 'table', 'laypage', 'layer'], function(){
    var form = layui.form;
    form.render(); //更新全部，防止input多选和单选框不显示问题
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    form.on('submit(commit)', function(data){
        $.ajax({
            type: "post",
            url:"<?= Url::to(['manage/user/update-user-info']); ?>",
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
                } else if(result.code == 5001) {
                    layer.alert('登录状态异常', {icon: 2}, function(index){
                        top.location.href="../user/login";
                    });
                } else {
                    layer.alert(result.msg, {icon: 2});
                }
            },
            error: function () {
                layer.alert('网络环境异常请检查', {icon: 2});
            }
        });
    });
});
</script>