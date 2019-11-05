<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<div class="layui-card">
    <div class="layui-header notselect">
        <div class="pull-left"><span><?= Html::encode($title ? $title : (isset($this->title) ? $this->title : null)) ?></span></div>
    </div>
</div>
<div class="layui-card-body">
    <div class="layui-card">
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
            <div class="layui-form-item">
                <label class="layui-form-label">banner封面图</label>
                <div class="layui-input-inline">
                    <img src="<?=isset($info['picture_url']) ? $info['picture_url']:"";?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">banner名称</label>
                <div class="layui-input-inline">
                    <?=isset($info['name']) ? $info['name']:"暂无";?>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                        <?=isset($info['sort']) ? $info['sort']: 0;?>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">过期时间</label>
                    <div class="layui-input-inline">
                        <?=isset($info['overdue_time']) ? date('Y-m-d', strtotime($info['overdue_time'])):"";?>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">跳转链接</label>
                    <div class="layui-input-inline">
                        <?=isset($info['url']) ? $info['url']:"";?>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">产品id</label>
                    <div class="layui-input-inline">
                        <?=isset($info['project_id']) ? $info['project_id']:"";?>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否上线</label>
                <div class="layui-input-inline">
                    <?=((isset($info['status']) && $info['status']==1) ? "是" : "否")?>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'layer'], function(){
    var form = layui.form;
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //监听提交
    var params = {};
});
</script>