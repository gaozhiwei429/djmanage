<?php
use yii\helpers\Url;
use \yii\helpers\Html;
/* @var $this yii\web\View */
?>
<?=Html::jsFile('@web/static/plugs/ace/ace.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<style>
    select.block{
        display:none!important;
    }
</style>
<style type="text/css">
    .uploader-list {
        margin-left: -15px;
    }
    .uploader-list .info {
        position: relative;
        margin-top: -25px;
        background-color: black;
        color: white;
        filter: alpha(Opacity=80);
        -moz-opacity: 0.5;
        opacity: 0.5;
        width: 100px;
        height: 25px;
        text-align: center;
        display: none;
    }

    .uploader-list .handle {
        position: relative;
        background-color: black;
        color: white;
        filter: alpha(Opacity=80);
        -moz-opacity: 0.5;
        opacity: 0.5;
        width: 100px;
        text-align: right;
        height: 18px;
        margin-bottom: -18px;
        display: none;
    }

    .uploader-list .handle span {
        margin-right: 5px;
    }
    .uploader-list .handle span:hover {
        cursor: pointer;
    }
    .uploader-list .file-iteme {
        margin: 12px 0 0 15px;
        padding: 1px;
        float: left;
    }
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <!-- 表单搜索 开始 -->
        <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <?=isset($info['title']) ? $info['title']:"";?>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">长标题</label>
                <div class="layui-input-block">
                    <?=isset($info['subtitle']) ? $info['subtitle']:"";?>
                </div>
            </div>
            <div class="layui-form-item layui-upload">
                <label class="layui-form-label">封面图</label>
                <div class="layui-upload layui-input-block">
                    <img src="<?=isset($info['cover_img']) ? $info['cover_img']:"";?>" width="200px" height="150px">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">内容</label>
                <div class="layui-input-block">
                    <textarea id="layeditDemo"><?=isset($info['content']) ? $info['content']:"";?></textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">是否上线</label>
                <div class="layui-input-block">
                    <?=(isset($info['status']) && $info['status']==1) ? "是" : "否";?>
                </div>
            </div>
            <?php
            if(isset($technical_support_type_id) && $technical_support_type_id==3) {
            ?>
                <div class="layui-form-item layui-upload" id="fileUrlFile">
                    <label class="layui-form-label">说明书文件</label>
                    <div class="layui-input-block">
                        <?=isset($info['file_url']) ? $info['file_url']:"";?>
                    </div>
                </div>
            <?php
            }else if(isset($technical_support_type_id) && $technical_support_type_id==4) {
            ?>
            <div class="layui-form-item layui-upload" id="videoUrlFile">
                <label class="layui-form-label">视频文件</label>
                <div class="layui-input-block">
                    <video width="320" height="240" controls>
                        <source src="<?=isset($info['video_url']) ? $info['video_url']:"";?>" type="video/mp4">
                    </video>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="layui-form-item">
                <label class="layui-form-label">所属分类</label>
                <div class="layui-input-block">
                    <?php
                    if(isset($technicalSupportTypeList) && !empty($technicalSupportTypeList)) {
                        foreach($technicalSupportTypeList as $k=>$technicalSupportTypeInfo) {
                    ?>
                        <?=(isset($info['technical_support_type_id']) && $info['technical_support_type_id']==$technicalSupportTypeInfo['id']) ? (isset($technicalSupportTypeInfo['name']) ? $technicalSupportTypeInfo['name'] : "") : "";?>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
        </form>
    </div>
</div>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'upload','layedit', 'tree'], function(){
    var form = layui.form;
    var storage=window.localStorage;
    var table = layui.table;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    var layedit = layui.layedit;
    var $ = layui.jquery
        ,upload = layui.upload;

    //监听提交
    var params = {};
    var selfUrl = window.location.href;
    var index = layedit.build('layeditDemo',{
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
    }); //建立编辑器
    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>