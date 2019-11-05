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
            <?php
            if(isset($userInfo) && !empty($userInfo)) {
            ?>
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                    <input readonly="readonly" disabled="disabled" value='<?=isset($userInfo['username']) ? $userInfo['username']:"";?>' class="layui-input layui-bg-gray">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">用户昵称</label>
                <div class="layui-input-inline">
                    <input readonly="readonly" disabled="disabled" value='<?=isset($userInfo['nickname']) ? $userInfo['nickname']:"暂无";?>' class="layui-input layui-bg-gray">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">用户邮箱</label>
                <div class="layui-input-inline">
                    <input readonly="readonly" disabled="disabled" value='<?=isset($userInfo['email']) ? $userInfo['email']:"暂无";?>' class="layui-input layui-bg-gray">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">用户头像</label>
                <div class="layui-input-inline">
                    <?php
                    if(isset($userInfo['avatar_img'])) {
                    ?>
                        <a href="javascript:DataHtml('头像','<?=$userInfo['avatar_img']?>')">
                        　　<img alt='头像' title='头像' style='width:100px' src='<?=$userInfo['avatar_img']?>'/>
                        </a>
                    <?php
                    } else {
                    ?>
                        暂无
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">注册来源</label>
                <div class="layui-input-inline">
                    <?php
                    if(isset($userInfo['source'])) {
                        ?>
                        <?php
                        if($userInfo['source']==0) {
                            ?>
                            PC
                        <?php
                        } else if($userInfo['source']==1)
                            ?>
                            Android
                        <?php
                    } else if($userInfo['source']==2) {
                        ?>
                        Ios
                    <?php
                    } else if($userInfo['source']==3) {
                        ?>
                        H5
                    <?php
                    } else {
                    ?>
                        未知
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <?php
            }
            ?>
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
});
function DataHtml(name, url) {
    $("#displayimg").attr("src", url);
    var height = $("#displayimg").height();
    var width = $("#displayimg").width();
    layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        shadeClose: true,
        area: [width + 'px', height + 'px'], //宽高
        content: "<img alt=" + name + " title=" + name + " src=" + url + " />"
    });
}
</script>