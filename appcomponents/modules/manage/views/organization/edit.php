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
</style>
<div class="layui-card">
    <div class="layui-card-body">
        <div style="margin-bottom:0px;">
            <div class="admin-main layui-form layui-field-box">
                <!-- layui-btn-sm -->
                <button class="layui-btn layui-btn-sm" onclick="window.history.go(-1);">返回</button>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>添加部门</legend>
                </fieldset>

                <form autocomplete="off" class="layui-form" onsubmit="return false;" data-auto="true" action="#">
                    <input type="hidden" name="uuid" class="layui-input" value="<?=isset($dataInfo['uuid']) ? $dataInfo['uuid']:"";?>">
                    <div class="layui-form-item">
                        <label class="layui-form-label"><span class="require-text">*</span>部门名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入党组织名称至少4个字符" class="layui-input" value="<?=isset($dataInfo['title']) ? $dataInfo['title']:"";?>">
                        </div>
                        <div class="layui-form-mid layui-word-aux">在组织架构上显示的党组织名称</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>上级部门
                        </label>
                        <div class="layui-input-inline" style="width: 500px">
                            <select name="parent_uuid" lay-filter="parent_uuid" id="Jorganization" lay-verify="required" lay-search=""></select>
                        </div>
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
                            <span class="require-text">*</span>组织类型</label>
                        <div class="layui-input-inline" style="width: 500px">
                            <select name="organization_type" lay-verify="required" lay-search="">
                                <option value=''>请选择组织类型</option>
                                <?php
                                if(isset($organizationTypeArr) && !empty($organizationTypeArr)) {
                                    foreach ($organizationTypeArr as $organizationKey => $organizationVal) {
                                ?>
                                        <option value="<?=$organizationKey;?>" <?=(isset($dataInfo['organization_type'])&&$dataInfo['organization_type']==$organizationKey) ? "selected" : "";?>><?=$organizationVal;?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>支部类型</label>
                        <div class="layui-input-inline" style="width: 500px">
                            <select name="branch_type"lay-verify="required" lay-search="">
                                <option value=''>请选择支部类型</option>
                                <?php
                                if(isset($branchTypeArr) && !empty($branchTypeArr)) {
                                    foreach ($branchTypeArr as $branchTypeKey => $branchTypeVal) {
                                        ?>
                                        <option value="<?=$branchTypeKey;?>" <?=(isset($dataInfo['branch_type'])&&$dataInfo['branch_type']==$branchTypeKey) ? "selected" : "";?>><?=$branchTypeVal;?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>排序</label>
                        <div class="layui-input-inline">
                            <input type="number" name="sort" placeholder="" class="layui-input" lay-verify="number" value="<?=isset($dataInfo['sort']) ? $dataInfo['sort']:0;?>">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">
                            <span class="require-text">*</span>描述内容</label>
                        </label>
                        <div class="layui-input-label">
                            <textarea placeholder="请输入描述内容" class="layui-textarea" name="content" lay-verify="content" id="layeditDemo"><?=isset($dataInfo['content']) ? $dataInfo['content']:"";?></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="submitOrganization">立即提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?=Html::jsFile('@web/static/dangjian/js/delelement.js?v='.date("ymd"), ['type' => "text/javascript"])?>
<script type="application/javascript">
layui.use(['form', 'table', 'laypage', 'upload','layedit', 'tree'], function(){
    var layedit = layui.layedit;
    var table = layui.table
        ,form = layui.form
        ,jq = layui.jquery
        ,$ = layui.jquery;
    var storage=window.localStorage;
    var userData = storage.getItem("userData");
    var headerParams = JSON.parse(userData);
    //创建一个编辑器
    var index = layedit.build('layeditDemo',{
        height: 180, //设置编辑器高度
        width: 300, //设置编辑器高度
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
            , 'video'
            , 'anchors'
            ,'table'
            , 'fullScreen'
        ]
    }); //建立编辑器
    layedit.set({
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

    //自定义验证规则
    form.verify({
        title: function(value){
            if(value.length < 4){
                return '名称至少4个字符！';
            }
        }
        ,content: function(value){
            layedit.sync(index);
        }
    });
    //监听提交
    form.on('submit(submitOrganization)', function(data){
        $.ajax({
            type: "post",
            url: "<?= Url::to(['common/organization/edit']); ?>",
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
    var organizationHtml = "<option value=''>请选择所属部门</option>";
    <?php
    if(isset($treeData) && !empty($treeData)) {
    $flag = 0;
    foreach($treeData as $treeInfo) {
    ?>
    <?php
        if(!$flag) {
//        $flag=1;
    ?>
    <?php
            }
    ?>
    <?php
    if(!$flag) {
    ?>
    organizationHtml+='<option value="<?=isset($treeInfo['parent_uuid']) ? $treeInfo['parent_uuid'] : 0;?>" disabled="disabled" <?=(isset($treeInfo['parent_uuid']) && isset($dataInfo['parent_uuid']) && $treeInfo['parent_uuid']==$dataInfo['parent_uuid']) ? "selected": "";?>><?=isset($treeInfo['flag']) ? $treeInfo['flag'] : "";?><?=isset($treeInfo['title']) ? $treeInfo['title'] : "";?></option>';
    <?php
    } else {
    ?>
    organizationHtml+='<option value="<?=isset($treeInfo['parent_uuid']) ? $treeInfo['parent_uuid'] : 0;?>" <?=(isset($treeInfo['parent_uuid']) && isset($dataInfo['parent_uuid']) && $treeInfo['parent_uuid']==$dataInfo['parent_uuid']) ? "selected": "";?>><?=isset($treeInfo['flag']) ? $treeInfo['flag'] : "";?><?=isset($treeInfo['title']) ? $treeInfo['title'] : "";?></option>';
    <?php
            }
    ?>
    <?php
    if((isset($uuid) && $uuid!="")) {
    if($treeInfo['uuid']!=$uuid) {
    if(!$flag) {
    $flag = 0;
    }
    } else {
    $flag = 1;
    }
    }
    ?>
    <?php
//    isset($parent_uuid) && $parent_uuid!==null
    if((isset($parent_uuid) && $parent_uuid!=null)) {
    if($treeInfo['parent_uuid']!=$parent_uuid) {
    if(!$flag) {
    $flag = 0;
    }
    } else {
    $flag = 1;
    }
    }
    ?>
    <?php
            }
        }
    ?>
    $("#Jorganization").html(organizationHtml);
    form.render(); //更新全部，防止input多选和单选框不显示问题
});
</script>