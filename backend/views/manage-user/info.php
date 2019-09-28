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
                    <?=isset($userInfo['username']) ? $userInfo['username']:"";?>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <?=isset($userInfo['nickname']) ? $userInfo['nickname']:"";?>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <?=(isset($userInfo['sex'])&&$userInfo['sex']==1) ? "男":((isset($userInfo['sex'])&&$userInfo['sex']==2) ? "女" : "");?>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">公司</label>
                <div class="layui-input-block">
                    <?=isset($userInfo['company']) ? $userInfo['company']:"暂无";?>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">部门</label>
                <div class="layui-input-block">
                        <?php
                        if(isset($departmentDataList)) {
                            foreach($departmentDataList as $departmentData){
                                ?>
                                <?php
                                if(isset($departmentData['id']) && (isset($departmentData['id']) && isset($userInfo['department_id']) && $departmentData['id']==$userInfo['department_id'])) {
                                    ?>
                                        <?=isset($departmentData['name']) ? $departmentData['name']:"";?>
                                <?php
                                }
                                ?>
                            <?php
                            }
                        }
                        ?>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">联系电话</label>
                <div class="layui-input-block">
                    <?=isset($userInfo['mobile']) ? $userInfo['mobile']:"暂无";?>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">联系邮箱</label>
                <div class="layui-input-block">
                    <?=isset($userInfo['email']) ? $userInfo['email']:"暂无";?>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">联系地址</label>
                <div class="layui-input-block">
                    <?=isset($userInfo['address']) ? $userInfo['address']:"暂无";?>
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

            <div class="layui-form-item text-center"></div>
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